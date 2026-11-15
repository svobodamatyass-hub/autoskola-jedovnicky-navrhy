# Autoškola Michal Jedovnický – WordPress šablona

Klasická WordPress šablona připravená podle aktuálního statického náhledu. Obsahuje mobilní navigaci, ceník, skutečné fotografie z původního webu autoškoly, odkaz na přihlášku a Google Mapy.

## Instalace

1. V administraci WordPressu otevřete **Vzhled → Šablony → Instalace šablon → Nahrát šablonu**.
2. Nahrajte aktuální ZIP šablony a aktivujte jej.
3. V **Nastavení → Obecné** ověřte finální URL `https://jedovnicky-autoskola.cz/`, název a český jazyk webu.
4. V **Vzhled → Přizpůsobit → Autoškola – obsah webu** upravte kontakty, strukturovanou kontaktní adresu, adresu mapy, ceny, logo, fotografie a pole **SEO a sdílení**; změny publikujte.
5. Před veřejným spuštěním potvrďte s klientem aktuálnost fotografií, délku kurzu, případné další poplatky, první jízdu, termíny a služby dostupné ve formuláři Moje Autoškola.
6. Ve WordPressu nastavte stránku se zásadami ochrany osobních údajů. Pokud je nastavena, šablona na ni v patičce odkazuje.

Úvodní stránka se vykresluje šablonou front-page.php; nezávisí na obsahu stránky v běžném blokovém editoru. Pole v nabídce Přizpůsobit pokrývají nadpis, kontakt, mapu, ceny, přihlášku a fotografie. Ostatní texty a struktura stránky jsou zatím ve front-page.php a vyžadují vývojářskou úpravu. Před ostrým nasazením je vhodné doplnit jejich editaci.

Google mapa i přihláška závisí na externích službách. Před skutečným spuštěním je nutné ověřit konkrétní místo, formulář a postup ochrany osobních údajů. Součástí šablony není hosting, nastavení domény ani provoz WordPressu.

Požadavky: WordPress 6.0+ a PHP 7.4+. Šablona nebyla v této relaci spuštěna v instalaci WordPressu ani ověřena na konkrétním hostingu.
Logo s průhledným pozadím je pracovní úprava původního podkladu. Pro finální verzi je vhodný originál dodaný klientem. Fotografie byly staženy z jeho původního webu a zmenšeny do WebP.

## SEO při spuštění na finální doméně

- Náhled na `chatgpt.site` obsahuje `noindex, follow`; ve vyhledávání má být až finální web na `jedovnicky-autoskola.cz`. Tato značka není součástí WordPress šablony.
- Na úvodní stránce šablona bez SEO pluginu nastaví titulek, popis, vlastní kanonickou URL z `home_url('/')`, Open Graph/Twitter metadata a `LocalBusiness` JSON-LD. Telefon a adresa v JSON-LD používají stejná pole jako viditelný kontakt. Neuvádíme neověřené provozní hodiny, další pobočky ani hodnocení v JSON-LD.
- Pokud se používá Yoast SEO, Rank Math, SEOPress nebo AIOSEO, výstup metadat šablony se vypne, aby nevznikaly duplicity. U jiného SEO pluginu zkontrolujte výsledný zdroj stránky a případné duplicity řešte ve funkci `aj_seo_plugin_active()`.
- Před otevřením indexace zkontrolujte **Nastavení → Zobrazování → Viditelnost pro vyhledávače** a v Search Console ověřte finální doménu. Ověřte dostupnost WordPress sitemapu na `/wp-sitemap.xml` a po spuštění ho odešlete v Search Console.
- Nastavte čtvercovou ikonu webu v PNG nebo ICO pro výsledek vyhledávání. Současné WebP logo není vhodný formát faviconu pro Google. Ideální je kvalitní originál od Michala.
- Při nahrazení původního webu zachovejte funkční adresu `/cenik/` nebo nastavte trvalé přesměrování na nový ceník. Před přesměrováním zkontrolujte i další staré URL a externí odkazy.
- Sjednoťte název, telefon, adresu a otevírací dobu mezi webem a firemním profilem Google. Účel druhé evidované provozovny na Brandlově musí potvrdit Michal; do dat o pobočkách ji zatím nepřidávejte.

Samotná šablona nezajišťuje registraci v Search Console ani pozice ve vyhledávání. Po nasazení je potřeba ověřit výsledné HTML, indexaci a data v Search Console.

Sociální odkazy se nastavují v **Vzhled → Přizpůsobit → Autoškola – obsah webu → Kontakt a mapa**. Ponechte je prázdné, dokud nebudou profily spolehlivě ověřené; web potom odkaz nezobrazí.
