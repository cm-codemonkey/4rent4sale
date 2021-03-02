<?php defined('_EXEC') or die;
$this->dependencies->getDependencies([
    'css' => [
        '{$path.plugins}chosen-select/chosen.css" type="text/css'
    ],
    'js' => [
        '{$path.js}contacto.js',
        '{$path.plugins}chosen-select/chosen.jquery.js'
    ],
    'other' => [
        '<script>$(function() { $(".chosen-select").chosen(); });</script>'
    ]
]);
?>
<header class="main-header">
    %{header}%
</header>
<section class="contact-background" data-image-src="{$background_contact}">
    <div class="content">
        <h1>{$title}</h1>
    </div>
</section>
<section class="contact">
    <div class="content">
        <div class="thumb-iconbox">
            <p><i class="material-icons">stay_current_portrait</i>{$contact_us_phone}<i class="material-icons">email</i>{$contact_us_email}<i class="material-icons">business</i>{$contact_us_address}</p>
        </div>
        <div class="space30"></div>
        <form name="contact" class="row">
            <div class="span6">
                <input type="text" name="name" placeholder="{$lang.contact_nombre}" value="">
            </div>
            <div class="span6">
                <input type="text" name="lastname" placeholder="{$lang.contact_lastname}" value="">
            </div>
            <div class="span6">
                <input type="email" name="email" placeholder="{$lang.contact_email}" value="">
            </div>
            <div class="span6">
                <input type="number" name="phone" placeholder="{$lang.phone}" value="">
            </div>
            <div class="span12">
                <select name="country" class="chosen-select">
                    <option value="">{$lang.country}</option>
                    <option value="Albania (+355)">{$lang.Albania}</option>
                    <option value="Alemania (+49)">{$lang.Alemania}</option>
                    <option value="Andorra (+376)">{$lang.Andorra}</option>
                    <option value="Angola (+244)">{$lang.Angola}</option>
                    <option value="Anguilla (1+264)">{$lang.Anguilla}</option>
                    <option value="Antártida (+672)">{$lang.Antartida}</option>
                    <option value="Antigua y Barbuda (1+268)">{$lang.Antigua_Barbuda}</option>
                    <option value="Arabia Saudita (+966)">{$lang.Arabia_Saudita}</option>
                    <option value="Argelia (+213)">{$lang.Argelia}</option>
                    <option value="Argentina (+54)">{$lang.Argentina}</option>
                    <option value="Armenia (+374)">{$lang.Armenia}</option>
                    <option value="Aruba isla (297+8)">{$lang.Aruba_isla}</option>
                    <option value="Ascensión isla (+247)">{$lang.Ascension_isla}</option>
                    <option value="Australia (+61)">{$lang.Australia}</option>
                    <option value="Austria (+43)">{$lang.Austria}</option>
                    <option value="Azerbaiyán (+994)">{$lang.Azerbaiyan}</option>
                    <option value="Bahamas (1+242)">{$lang.Bahamas}</option>
                    <option value="Bahrein (+973)">{$lang.Bahrein}</option>
                    <option value="Bangladesh (+880)">{$lang.Bangladesh}</option>
                    <option value="Barbados (1+246)">{$lang.Barbados}</option>
                    <option value="Belarus (1+246)">{$lang.Belarus}</option>
                    <option value="Bélgica (+32)">{$lang.Belgica}</option>
                    <option value="Belice (+501)">{$lang.Belice}</option>
                    <option value="Benin(+229)">{$lang.Benin}</option>
                    <option value="Bermudas (+1+441)">{$lang.Bermudas}</option>
                    <option value="Bielorrusia (+375)">{$lang.Bielorrusia}</option>
                    <option value="Birmania (+95)">{$lang.Birmania}</option>
                    <option value="Bolivia (+591)">{$lang.Bolivia}</option>
                    <option value="Bosnia y Herzegovina (+387)">{$lang.Bosnia_Herzegovina}</option>
                    <option value="Botswana (+267)">{$lang.Botswana}</option>
                    <option value="Brasil (+55)">{$lang.Brasil}</option>
                    <option value="Brunei (+673)">{$lang.Brunei}</option>
                    <option value="Bulgaria (+359)">{$lang.Bulgaria}</option>
                    <option value="Burkina Faso (+226)">{$lang.Burkina_Faso}</option>
                    <option value="Burundi (+257)">{$lang.Burundi}</option>
                    <option value="Bután (+975)">{$lang.Butan}</option>
                    <option value="Cabo Verde (+238)">{$lang.Cabo_Verde}</option>
                    <option value="Camboya (+855)">{$lang.Camboya}</option>
                    <option value="Camerún (+237)">{$lang.Camerun}</option>
                    <option value="Canadá (+1)">{$lang.Canada}</option>
                    <option value="Chile (+56)">{$lang.Chile}</option>
                    <option value="China (+86)">{$lang.China}</option>
                    <option value="Chipre (+357)">{$lang.Chipre}</option>
                    <option value="Ciudad del Vaticano (Santa Sede) (+379)">{$lang.Ciudad_Vaticano}</option>
                    <option value="Colombia (+57)">{$lang.Colombia}</option>
                    <option value="Corea (+82)">{$lang.Corea}</option>
                    <option value="Corea del Norte (+850)">{$lang.Corea_Norte}</option>
                    <option value="Costa de Marfíl (+255)">{$lang.Costa_Marfil}</option>
                    <option value="Costa Rica (+506)">{$lang.Costa_Rica}</option>
                    <option value="Croacia (+385)">{$lang.Croacia}</option>
                    <option value="Cuba (+53)">{$lang.Cuba}</option>
                    <option value="Curazao (599+9)">{$lang.Curazao}</option>
                    <option value="Dinamarca (+45)">{$lang.Dinamarca}</option>
                    <option value="Djibouti (+253)">{$lang.Djibouti}</option>
                    <option value="Dominica (1+809)">{$lang.Dominica}</option>
                    <option value="Ecuador (+593)">{$lang.Ecuador}</option>
                    <option value="Egipto (+20)">{$lang.Egipto}</option>
                    <option value="El Salvador (+503)">{$lang.Salvador}</option>
                    <option value="Emiratos Árabes Unidos (+971)">{$lang.Emiratos_Arabes_Unidos}</option>
                    <option value="Eritrea (+291)">{$lang.Eritrea}</option>
                    <option value="Eslovenia (+386)">{$lang.Eslovenia}</option>
                    <option value="España (+34)">{$lang.España}</option>
                    <option value="Estados Unidos (+1)">{$lang.Estados_Unidos}</option>
                    <option value="Estonia (+372)">{$lang.Estonia}</option>
                    <option value="Etiopía (+251)">{$lang.Etiopia}</option>
                    <option value="Fiji (+679)">{$lang.Fiji}</option>
                    <option value="Filipinas (+63)">{$lang.Filipinas}</option>
                    <option value="Finlandia (+358)">{$lang.Finlandia}</option>
                    <option value="Francia (+33)">{$lang.Francia}</option>
                    <option value="Gabón (+241)">{$lang.Gabon}</option>
                    <option value="Gambia (+220)">{$lang.Gambia}</option>
                    <option value="Georgia (+995)">{$lang.Georgia}</option>
                    <option value="Ghana (+233)">{$lang.Ghana}</option>
                    <option value="Granada (1+809)">{$lang.Granada}</option>
                    <option value="Grecia (+30)">{$lang.Grecia}</option>
                    <option value="Groenlandia (+299)">{$lang.Groenlandia}</option>
                    <option value="Guadalupe (+590)">{$lang.Guadalupe}</option>
                    <option value="Guam (+671)">{$lang.Guam}</option>
                    <option value="Guatemala (+502)">{$lang.Guatemala}</option>
                    <option value="Gunaya (+592)">{$lang.Gunaya}</option>
                    <option value="Guayana Francesa (+594)">{$lang.Guayana_Francesa}</option>
                    <option value="Guinea Ecuatorial (+240)">{$lang.Guinea_Ecuatorial}</option>
                    <option value="Guinea-Bissau (+245)">{$lang.Guinea_Bissau}</option>
                    <option value="Haití (+509)">{$lang.Haiti}</option>
                    <option value="Honduras (+504)">{$lang.Honduras}</option>
                    <option value="Hungría (+36)">{$lang.Hungria}</option>
                    <option value="India (+91)">{$lang.India}</option>
                    <option value="Indonesia (+62)">{$lang.Indonesia}</option>
                    <option value="Irak (+98)">{$lang.Irak}</option>
                    <option value="Irán (+964)">{$lang.Iran}</option>
                    <option value="Irlanda (+353)">{$lang.Irlanda}</option>
                    <option value="Islandia (+354)">{$lang.Islandia}</option>
                    <option value="Islas Caimán (1+345)">{$lang.Islas_Caiman}</option>
                    <option value="Islas Cook (+682)">{$lang.Islas_Cook}</option>
                    <option value="Islas Faroe (+298)">{$lang.Islas_Faroe}</option>
                    <option value="Islas Malvinas (+500)">{$lang.Islas_Malvinas}</option>
                    <option value="Islas Marianas del Norte (+670)">{$lang.Islas_Marianas_Norte}</option>
                    <option value="Islas Marshall (+692)">{$lang.Islas_Marshall}</option>
                    <option value="Islas Palau (+680)">{$lang.Islas_Palau}</option>
                    <option value="Islas Salomón (+677)">{$lang.Islas_Salomon}</option>
                    <option value="Islas Vírgenes (EEUU) (1+340)">{$lang.Islas_Virgenes}</option>
                    <option value="Israel (+972)">{$lang.Israel}</option>
                    <option value="Italia (+39)">{$lang.Italia}</option>
                    <option value="Jamaica (+1+876)">{$lang.Jamaica}</option>
                    <option value="Japón (+81)">{$lang.Japon}</option>
                    <option value="Jordania (+962)">{$lang.Jordania}</option>
                    <option value="Kenia (+264)">{$lang.Kenia}</option>
                    <option value="Líbano (+961)">{$lang.Libano}</option>
                    <option value="Liberia (+231)">{$lang.Liberia}</option>
                    <option value="Libia (+218)">{$lang.Libia}</option>
                    <option value="Lituania (+370)">{$lang.Lituania}</option>
                    <option value="Luxemburgo (+352)">{$lang.Luxemburgo}</option>
                    <option value="Macedonia, Ex-República Yugoslava (+389)">{$lang.Macedonia}</option>
                    <option value="Madagascar (+261)">{$lang.Madagascar}</option>
                    <option value="Malasia (+60)">{$lang.Malasia}</option>
                    <option value="Malawi (+265)">{$lang.Malawi}</option>
                    <option value="Maldivas (+960)">{$lang.Maldivas}</option>
                    <option value="Malí (+223)">{$lang.Mali}</option>
                    <option value="Malta (+356)">{$lang.Malta}</option>
                    <option value="Marruecos (+212)">{$lang.Marruecos}</option>
                    <option value="Martinica (+596)">{$lang.Martinica}</option>
                    <option value="Mauricio (+230)">{$lang.Mauricio}</option>
                    <option value="Mauritania (+222)">{$lang.Mauritania}</option>
                    <option value="México (+52)">{$lang.Mexico}</option>
                    <option value="Micronesia (+691)">{$lang.Micronesia}</option>
                    <option value="Moldavia (+373)">{$lang.Moldavia}</option>
                    <option value="Mónaco (+377)">{$lang.Monaco}</option>
                    <option value="Mongolia (+976)">{$lang.Mongolia}</option>
                    <option value="Montserrat (1+664)">{$lang.Montserrat}</option>
                    <option value="Mozambique (+258)">{$lang.Mozambique}</option>
                    <option value="Nauru (+674)">{$lang.Nauru}</option>
                    <option value="Nepal (+977)">{$lang.Nepal}</option>
                    <option value="Nicaragua (+505)">{$lang.Nicaragua}</option>
                    <option value="Níger (+227)">{$lang.Niger}</option>
                    <option value="Nigeria (+234)">{$lang.Nigeria}</option>
                    <option value="Niue (+683)">{$lang.Niue}</option>
                    <option value="Noruega (+47)">{$lang.Noruega}</option>
                    <option value="Nueva Caledonia (+687)">{$lang.Nueva_Caledonia}</option>
                    <option value="Nueva Zelanda (+64)">{$lang.Nueva_Zelanda}</option>
                    <option value="Omán (+968)">{$lang.Oman}</option>
                    <option value="Países Bajos (+31)">{$lang.Paises_Bajos}</option>
                    <option value="Panamá (+507)">{$lang.Panama}</option>
                    <option value="Papúa Nueva Guinea (+675)">{$lang.Papua_Nueva_Guinea}</option>
                    <option value="Paquistán (+92)">{$lang.Paquistan}</option>
                    <option value="Paraguay (+595)">{$lang.Paraguay}</option>
                    <option value="Perú (+51)">{$lang.Peru}</option>
                    <option value="Polonia (+48)">{$lang.Polonia}</option>
                    <option value="Portugal (+351)">{$lang.Portugal}</option>
                    <option value="Puerto Rico (+1+787)">{$lang.Puerto_Rico}</option>
                    <option value="Qatar (+974)">{$lang.Qatar}</option>
                    <option value="Reino Unido (+44)">{$lang.Reino_Unido}</option>
                    <option value="República Checa (+420)">{$lang.Republica_Checa}</option>
                    <option value="República de Sudáfrica (+27)">{$lang.Republica_Sudafrica}</option>
                    <option value="República Dominicana (1+809)">{$lang.Republica_Dominicana}</option>
                    <option value="República Eslovaca (+421)">{$lang.Republica_Eslovaca}</option>
                    <option value="Reunión (+262)">{$lang.Reunion}</option>
                    <option value="Ruanda (+250)">{$lang.Ruanda}</option>
                    <option value="Rumania (+40)">{$lang.Rumania}</option>
                    <option value="Rusia (+7)">{$lang.Rusia}</option>
                    <option value="Samoa (+685)">{$lang.Samoa}</option>
                    <option value="Samoa Americana (+684)">{$lang.Samoa_Americana}</option>
                    <option value="San Marino (+378)">{$lang.San_Marino}</option>
                    <option value="San Vicente y Granadinas (+1+809)">{$lang.San_Vicente_Granadinas}</option>
                    <option value="Santa Helena (+290)">{$lang.Santa_Helena}</option>
                    <option value="Santa Lucía (1+758)">{$lang.Santa_Lucia}</option>
                    <option value="Santo Tomé y Príncipe (+239)">{$lang.Santo_Tome_Principe}</option>
                    <option value="Senegal (+221)">{$lang.Senegal}</option>
                    <option value="Seychelles (+248)">{$lang.Seychelles}</option>
                    <option value="Sierra Leona (+232)">{$lang.Sierra_Leona}</option>
                    <option value="Singapur (+65)">{$lang.Singapur}</option>
                    <option value="Siria (+963)">{$lang.Siria}</option>
                    <option value="Somalia(+252)">{$lang.Somalia}</option>
                    <option value="Sri Lanka (+94)">{$lang.Sri_Lanka}</option>
                    <option value="Suazilandia (+268)">{$lang.Suazilandia}</option>
                    <option value="Sudán (+249)">{$lang.Sudan}</option>
                    <option value="Suecia (+46)">{$lang.Suecia}</option>
                    <option value="Suiza (+41)">{$lang.Suiza}</option>
                    <option value="Surinam (+597)">{$lang.Surinam}</option>
                    <option value="Tailandia (+66)">{$lang.Tailandia}</option>
                    <option value="Taiwán (+886)">{$lang.Taiwan}</option>
                    <option value="Tanzania (+255)">{$lang.Tanzania}</option>
                    <option value="Tonga (+676)">{$lang.Tonga}</option>
                    <option value="Trinidad y Tobago (1+868)">{$lang.Trinidad_Tobago}</option>
                    <option value="Túnez (+216)">{$lang.Tunez}</option>
                    <option value="Turkmenistán (+216)">{$lang.Turkmenistan}</option>
                    <option value="Turquía (+90)">{$lang.Turquia}</option>
                    <option value="Tuvalu (+688)">{$lang.Tuvalu}</option>
                    <option value="Ucrania (+380)">{$lang.Ucrania}</option>
                    <option value="Uganda (+256)">{$lang.Uganda}</option>
                    <option value="Uruguay (+598)">{$lang.Uruguay}</option>
                    <option value="Vanuatu (+678)">{$lang.Vanuatu}</option>
                    <option value="Venezuela (+58)">{$lang.Venezuela}</option>
                    <option value="Vietnam (+84)">{$lang.Vietnam}</option>
                    <option value="Yemen (+967)">{$lang.Yemen}</option>
                    <option value="Yugoslavia (+381)">{$lang.Yugoslavia}</option>
                    <option value="Zambia (+260)">{$lang.Zambia}</option>
                    <option value="Zimbabue (+263)">{$lang.Zimbabue}</option>
                </select>
            </div>
            <div class="span12">
                <textarea name="message" placeholder="{$lang.contact_write_email}"></textarea>
            </div>
        </form>
        <div>
            <p class="error style2"></p>
        </div>
        <a id="send" href="" class="btn"="">{$lang.btn_send}</a>
    </div>
</section>
