![](https://avatars0.githubusercontent.com/u/4995607?v=3&s=100)

NFQ Akademija
============

# Intro

Sveiki! Tai yra Jūsų startinis projekto "template". 
Šioje repositorijoje rasite Symfony 3.1 startinį prjekto paketa su jau paruoštais 
visais reikalingais failais ir įrankiais darbui:
 
- Lokalaus development'o aplinka (docker) (PHP 7, Maria DB, Nginx)
- Pradinis bundle (AppBundle), kartu su stiliaus failais ir kitais dalykėliais.
- Idiegtas bootstrap
- Asset'ų buildinimas (npm. gulp, sass)
- Travis CI template


# Paleidimo instrukcija

Metai iš metų studentai maldavo jog galėtų dirbti su Windowsais akademijos metu. 
Tad skubu pranešti gerą žinią, Dievai išklausė Jūsų maldas ir nuo šiol galėsite teoriškai naudoti Windowsus!

> Perspejimas: Itin kieti profesionalai nenaudoja niekam tikusių operacinių sistemų. 

### Reikės dokerio

Naudosime naujausią dokerio versiją, kuri įgalina virtualizaciją be Virtualbox ar Vmware. 
Tam reikės, kad jūsų kompiuterio procesorius palaikytų Hyper-V.

Parsisiunčiame įranki iš [čia](https://www.docker.com/products/overview#/install_the_platform) pagal savo platformą.
Instaliuojate.

Toliau jums reikės git'o. Jei neturite normalaus terminalo, kuriame jau "by default" `git`komanda būtų, atsisiunčiame iš [čia](https://git-scm.com/downloads) .
Instaliuojate.


### Projekto paleidimas

Downloadinat šią repositoriją. Taip taip, viršuje kairėje rasite žalią mygtuką ant kurio parašyta "download", tada pasirenkate zip failo parsisiuntimą. 
Extractinat turinį į savo megstamą projektų direktoriją.

Einate į šią direktoriją su terminalu. Paprastai bus komanda `cd <path>`.

Toliau leidžiame komandas esančias žemiau:

```bash

docker-compose up -d
docker-compose exec fpm composer install --prefer-dist -n
docker-compose run npm npm install
docker-compose run npm gulp

```

### Kaip pamatyti kas atsitiko?

Atsidarote naršyklę ir einate į http://127.0.0.1:8000 , 
jei nematote užrašo NFQ Akademija, reiškia kažkur susimovėte, 
tokiu atveju viską ištrinat ir kartojate iš naujo kol gausis.

### Kaip prisijungti prie duomenų bazės?

Jungiaties į 127.0.0.1, naudojat portą 3000
Username: root
Password: root

### Troubleshooting'as

Jeigu kažkas nutiko netaip, na atsirado raudona eilutė, ar tiesiog nutruko ir nieko nerodo, neatsidaro naršyklėje svetainė, tai pirmas žingsnis būtų paleisti komandą:

```
docker-compose logs
```

Nepamirškite kad galima nurodyti norima procesa. Taip pat ir 'grepinti'.

```
docker-compose logs mariadb
```

### Feedbackas

Jeigu taip nutiktų kad repositorijoje, projekto template ar instrukcijoje rastumėte klaidą, tai nesišnibždėkite vieni tarp kitų, o sukurkite "issue". 
O jei atidarysite "pull requestą" su fixu, gausite iškart 1000 karmos taškų.
