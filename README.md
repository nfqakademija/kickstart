![](https://avatars0.githubusercontent.com/u/4995607?v=3&s=100)

NFQ Akademija
============

# Intro

Sveiki! Tai yra Jūsų startinis projekto "template". 
Šioje repositorijoje rasite Symfony `4.3.5` minimalų projekto paketą su jau paruoštais 
visais reikalingais failais ir įrankiais darbui:
 
- Lokalaus development'o aplinka (docker) (PHP 7.3, MySql DB, Nginx)
- Paprastas pavyzdys (Controller, Template, CSS)
- Įdiegtas bootstrap
- Asset'ų buildinimas (encore, yarn, sass)
- GitHub actions (CI) pavyzdys

# Paleidimo instrukcija

Metai iš metų studentai maldavo jog galėtų dirbti su Windows'ais akademijos metu.
 Bet nepaisant nieko, tolerancijos ir palaikymo Windows operacinei niekada nebuvo ir nebus.  

> Perspėjimas: Itin kieti profesionalai nenaudoja niekam tikusių operacinių sistemų. 

### Reikės dokerio

[:video_camera: Diegimo pavyzdys](https://youtu.be/75b876HcTl8) 

Naudosime naujausią dokerio versiją, kuri įgalina virtualizaciją be Virtualbox ar Vmware.
 Tam reikės, kad jūsų kompiuterio procesorius palaikytų [Hypervisor](https://en.wikipedia.org/wiki/Hypervisor).
 Nėra dėl ko nerimauti, dabartiniai kompiuteriai kone visi turi šį palaikymą.

Parsisiunčiate ir įsidiegiate įrankį iš [čia](https://docs.docker.com/install/linux/docker-ce/ubuntu/). Iškart įdiegus reikia pasidaryti, kad `docker` būtų galima naudoti be root teisių, kaip tai padaryti rasite [čia]( https://docs.docker.com/install/linux/linux-postinstall/#manage-docker-as-a-non-root-user).

Parsisiunčiate ir įsidiegiate `docker-compose` iš [čia](https://github.com/docker/compose/releases).

Taip pat rekomenduojama įsidiegti [Kitematic](https://github.com/docker/kitematic/releases). Patartina naudoti [v0.17.7](https://github.com/docker/kitematic/releases/tag/v0.17.7), nes tai paskutinė stabili versija, palaikoma Ubuntu.
 Šis įrankis padės geriau organizuoti dokerio konteinerius. 

#### Versijų reikalavimai

* docker: `18.x-ce`
* docker-compose: `1.23.2`


### Projekto paleidimas

[:video_camera: Paleidimo pavyzdys](https://youtu.be/oaj0y_juMuo) 

Pasileidžiant pirmą kartą būdavo įveliama daug klaidų, todėl padaryti _script'ai_ dažniausiems atvejams.

* Pasileidžiama infrastruktūrą per `docker`į:
```bash
scripts/start.sh
```

* Įsidiegiame PHP ir JavaScript bibliotekas:
```bash
scripts/install-first.sh
```

* Pasižiūrime, ar veikia.
  Naršyklėje atidarius [`http://127.0.0.1:8000/`](http://127.0.0.1:8000/) turėtų rašyti `NFQ Akademija`

* Pabaigus, gražiai išjungiame:
```bash
scripts/stop.sh
```

### Patogiai darbo aplinkai

[:video_camera: Komandinės eilutės naudojimo pavyzdys](https://youtu.be/s4y5LOipr4U) 

* _Development_ režimas (detalesnė informacija apie klaidas, automatiškai generuojami JavaScript/CSS):
```bash
scripts/install-dev.sh
```

* _Production_ režimas (imituoti, kaip daroma LIVE serveryje. Plačiau [.deploy/build.sh](.deploy/build.sh)):
```bash
scripts/install-prod.sh
```

* Jei norite pridėti PHP biblioteką arba dirbti su Symfony karkasu per komandinę eilutę:
```bash
scripts/backend.sh
```

* Jei norite pridėti JavaScript/CSS biblioteką arba dirbti su Symfony Encore komponentu per komandine eilutę:
```bash
scripts/frontend.sh
```

* Jei norite dirbti su MySql duomenų baze:
```bash
scripts/mysql.sh
```

* Jei nesuprantate, kas vyksta su infrastruktūra, praverčia pažiūrėti į `Log`'us:
```bash
scripts/logs.sh
```

* Jei kažką stipriai sugadinote ir niekaip nepavyksta atstatyti.
  Viską pravalyti (**naudokite atsakingai**) galima su:
```bash
scripts/clean-and-start-fresh.sh
```

### Dažniausiai užduodami klausimai

* **Kaip įkelti savo pakeitimus į LIVE?**
Jei viskas gerai sukonfiguruota, užteks sudėti pakeitimus į `master`.
Jei neveiks, plačiau žr. [įkėlimo į serverį dokumentacijoje](https://github.com/nfqakademija/docker/blob/master/docs/deploy-project.md)

* **Kaip prisijungti prie duomenų bazės su savo mėgstamu MySql redagtoriumi?**
Trumpai: `scripts/mysql.sh` atspausdina visus prisijungimus.
Plačiau žr. [MySql GUI dokumentacijoje](https://github.com/nfqakademija/docker/blob/master/docs/use-mysql-with-gui.md)

* **Kaip pasileisti xDebug?**
Trumpai: `./scripts/backend.sh /enable_xdebug.sh <TAVO_KOMPO_IP_ADRESAS>`
Plačiau žr. [xDebug dokumentacijoje](https://github.com/nfqakademija/docker/blob/master/docs/setup-xdebug.md)

* **Turių daugiau techninių klausimų?**
Google ir StackOverflow yra geriausi tavo draugai.
Nepavykus – kreipkis į savo mentorių. Jei jis nepadės,
nukreips į atitinkamą lektorių arba pamokys `git blame`,
kad žinotumei, kur kreiptis toliau. 

### Feedbackas

Jeigu taip nutiktų, kad repositorijoje, projekto template ar instrukcijoje rastumėte klaidą, tai nesišnibždėkite vieni tarp kitų, o sukurkite "issue". 
O jei atidarysite "pull requestą" su fixu, gausite iškart 1000 karmos taškų.
