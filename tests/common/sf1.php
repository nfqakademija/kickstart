<?php

class GitHubActions
{
    private $errors = 0;

    function error($file, $line, $context, $text)
    {
        $this->errors++;
        $context = trim($context);
        echo "Testing file: $file\n";
        echo "Testing line: $context\n";
        $line++; // To show notice bellow line
        echo "::error file=$file,line=$line,col=0::$text\n";
    }

    function warning($file, $line, $context, $text)
    {
        $context = trim($context);
        echo "Testing file: $file\n";
        echo "Testing line: $context\n";
        $line++; // To show notice bellow line
        echo "::warning file=$file,line=$line,col=0::$text\n";
    }

    function hadErrors()
    {
        return $this->errors > 0;
    }
}

abstract class Technology
{
    /** @var GitHubActions */
    private $gitHubActions;

    /**
     * @param GitHubActions $gitHubActions
     */
    public function __construct(GitHubActions $gitHubActions)
    {
        $this->gitHubActions = $gitHubActions;
    }

    protected function root()
    {
        return dirname(dirname(__DIR__));
    }

    protected function recursiveScan($root, $extension)
    {
        $directory = new RecursiveDirectoryIterator($root);
        $iterator = new RecursiveIteratorIterator($directory);
        $matches = [];
        /** @var SplFileInfo $item */
        foreach ($iterator as $item) {
            if ($item->getExtension() === $extension) {
                $matches[] = $item->getRealPath();
            }
        }
        return $matches;
    }

    abstract function files();

    function relative($path)
    {
        return substr($path, strlen($this->root() . '/'));
    }
}

class Twig extends Technology
{
    function files()
    {
        return $this->recursiveScan($this->root() . '/templates/', 'twig');
    }
}

class Scss extends Technology
{
    function files()
    {
        return $this->recursiveScan($this->root() . '/assets/', 'scss');
    }
}

class Php extends Technology
{
    function files()
    {
        return $this->recursiveScan($this->root() . '/src/', 'php');
    }
}

function contains($line, $needle)
{
    return strpos($line, $needle) !== false;
}

$actions = new GitHubActions();
$twig = new Twig($actions);
$files = $twig->files();
foreach ($files as $file) {
    $path = $twig->relative($file);
    $lines = file($file);
    foreach ($lines as $nr => $line) {

        // Common mistakes
        if (contains($line, '/student')) {
            $actions->error($path, $nr, $line, "Twig'e visi keliai turėtų naudoti path komandą. https://symfony.com/doc/current/templates.html#linking-to-pages");
        }
        if (contains($line, '|escape') || contains($line, '|e ') || contains($line, '| e ')) {
            if (!contains($line, "escape('url')")) {
                $actions->error($path, $nr, $line, "Symfony standartiškai yra įjungęs autoescape, tai papildomai rašyti |escape filtro nereikia. https://symfony.com/doc/4.3/templates.html#output-escaping");
            }
        }
        if (contains($line, 'action="/student"') || contains($line, ' href="/"') || contains($line, ' href="/student') || contains($line, "href='/'")) {
            $actions->error($path, $nr, $line, "Visoms nuorodoms reikėtų naudoti path komandą, nes pakeitus PHP/YAML pusėje bus sunku sugaudyti visus pakeitimu Twig'e. https://symfony.com/doc/4.2/templating.html#linking-to-pages");
        }
        if (contains($line, 'href="https://hw1.nfq2019.online/students.json"')) {
            $actions->error(
                $path,
                $nr,
                $line,
                "Duomenų failą reikėtų laikyti GitHub'e. Nes tavo sistemos rezultatas priklauso nuo students.json failo. " .
                "Jei aš kitą semestrą jį pakeisiu – tai tavo sistema suluš?.. " .
                "Taip pat, jei leisi automatinius testus savo projektui – norėsis, kad visi failai būtų lokaliai (dėl stabilumo ir greičio)"
            );
        }
        if (contains($line, '{% set ')) {
            $actions->error(
                $path,
                $nr,
                $line,
                "Symfony karkase speciailiai atskiriama verslo logika (Controller/PHP) ir atvaizdavimas (Twig). " .
                "Todėl visus sudėtingesnius apskaičiavimus geriau laikyti PHP pusėje, nes PHP kodą yra pogiau automatiškai testuoti" .
                "arba derinti (debug) negu iš Twig sugeneruotą kodą. " .
                "Realiuose projektuose ši problema taip pat sprendžiama ir su nepriklausomai ištestuojamais https://symfony.com/doc/current/templating/twig_extension.html " .
                "Namų darbe užtenkta tiesiog perkleti logiką į Controller");
        }
        if (contains($line, '{{ controller_name }}')) {
            $actions->warning($path, $nr, $line, "Verta nepalikinėti šiukšlių, nes kolegos skaitys VISUS tavo kodo pakeitimus. https://help.github.com/en/github/collaborating-with-issues-and-pull-requests/about-pull-request-reviews");
        }
        if (contains($line, "request->get('name')") || contains($line, '$request->get("name")') || contains($line, "request->get('project')")) {
            $actions->warning(
                $path,
                $nr,
                $line,
                "Gera praktika yra išreikštinai pasakyti, kokia yra standartinė reikšmė (kai naudotjas nenurodo parametero), " .
                "nes PHP kalboje neakivaizdu, kas bus greažinta: '', null, false ar 0"
            );
        }
    }
}

$scss = new Scss($actions);
$files = $scss->files();
foreach ($files as $file) {
    $path = $scss->relative($file);
    $lines = file($file);
    foreach ($lines as $nr => $line) {
        if (contains($line, 'background-color: #')) {
            $actions->error(
                $path,
                $nr,
                $line,
                "SCSS visa nauda ir yra, kad galima naudoti kintamuosius, o ne rašyti pliką CSS. " .
                "Pabandyk tą patį rezultatą gauti praplėčiant Bootstrap per kintamuosius. " .
                "https://getbootstrap.com/docs/4.0/getting-started/theming/#variable-defaults"
            );
        }
    }
}

$php = new Php($actions);
$files = $php->files();
foreach ($files as $file) {
    $path = $php->relative($file);
    $lines = file($file);
    foreach ($lines as $nr => $line) {
        if (contains($line, 'urldecode(')) {
            $actions->error(
                $path,
                $nr,
                $line,
                "Twigas specialiai padarytas, kad išspręstų dažniausias formatavimo problemas. " .
                "Nes jei pakeisime atvaizdavimą (pvz. text e-mail), tai surankioti visas vietas bus sunkiau. " .
                "https://twig.symfony.com/doc/3.x/filters/url_encode.html"
            );
        }
        if (contains($line, 'hw1.nfq2019.online/students.json')) {
            $actions->error(
                $path,
                $nr,
                $line,
                "Duomenų failą reikėtų laikyti GitHub'e. Nes tavo sistemos rezultatas priklauso nuo students.json failo. " .
                "Jei aš kitą semestrą jį pakeisiu – tai tavo sistema suluš?.. " .
                "Taip pat, jei leisi automatinius testus savo projektui – norėsis, kad visi failai būtų lokaliai (dėl stabilumo ir greičio)"
            );
        }
        if (contains($line, "file_get_contents('../public/students.json')")) {
            $actions->warning(
                $path,
                $nr,
                $line,
                "Alternatyva būtų naudoti Symfony KernelInterface. " .
                "Tada mažiau priklausytym nuo PHP failo perkėlimo į kitą katalogą. " .
                "https://www.php.net/manual/en/function.set-include-path.php"
            );
        }
    }
}

if ($actions->hadErrors()) {
    echo "!!!!! Not all tests passed. Check GitHub 'File changes' tab for line to line annotations !!!!!\n";
    exit(1);
}