  Sociālā pieteikšanās jeb social login lietotājiem ir vienreizēja pierakstīšanās. Izmantojot esošo pieteikšanās informāciju no tāda sociālā tīklu nodrošinātāja kā Twitter, Facebook vai Google, lietotājs var pierakstīties trešās puses vietnē, nevis izveidot jaunu kontu speciāla jauniepazītajai tīmekļa vietnei. Tas vienkāršo lietotāju reģistrāciju un pieteikšanos. Šajā readme failā tiks izklāsīts, kā integrēt Google Login PHP tīmekļa vietnē. Tiek izmantots Google OAuth API, kas ir viegls veids, kā pievienot pieteikšanos. 
  # Kāpēc sociālā pieteikšanās ir nepieciešama?
1. Saskaņā ar WEB Hosting Buzz aptauju, 86% lietotāju ziņo par to, ka tīmekļa vietnēs ir jāizveido jauni konti. Daži no šiem lietotājiem drīzāk pametīs jūsu vietni, nevis reģistrēsies, kas nozīmē, ka sociālās pieteikšanās nodrošināšana lietotnē palielinās jūsu vietnes reģistrācijas skaitu(objekts). 
2. Sociālā tīkla pakalpojumu sniedzējs ir atbildīgs par lietotāja e-pasta verificēšanu. Ja pakalpojumu sniedzējs koplieto šo informāciju, piemēram, pakaplojumā Twitter netiek kopīgota lietotāja e-pasta adrese, tad var iegūt īstu e-pasta adresi, nevis viltotas e-pasta adreses, kuras daži lietoāji parasti izmanto, lai reģistrētos tīmekla vietnēs. 
3. Sociālo tīklu nodrošinātāji var sniegt papildu informāciju par lietotājiem, piemēram, par atrašanās vietu, interesēm, dzimšanas dienu un daudz ko citu. Izmantojot šos datus, varat lietotājiem atlasīt personalizētu saturu. 
4. Lietotāji parasti neatjaunina savus profilus lielākajā daļā lietojumprogrammu, ko viņi izmanto, bet dara to sociālājos tīklos. Tāpēc sociālās pieteikšanās nodrosīna precīzu informāciju par lietotāju.
# Kā darbojas sociālā pieteikšanās?
1. Lietotājs pieslēdzas tīmekļa vietnē un izvēlas sociālo tīklu nodrošinātāju;
2. Sociālo tīklu pakalpojumu sniedzējam tiek nosūtīts pieteikšanās pieprasījums;
3. Tiklīdz sociālā tīkla pakalpojuma sniedzējs apstiprinās lietotāja identitāti, pašreizējais lietotājs saņems piekļuvi tīmekļa vietnei. Jauns lietotājs tiks reģistrēts kā jauns lietotājs un pēc tam pieteiksies tīmekļa vietnei.
# Darbības sociālā pieteikumvārda izveidei
1. Ir nepieciešams izveidot jaunu projektu iekš Google API Services;
2. Jāaktivizē OAuth Klienta ID opcija;
3. Tiks iegūti klienta id un klienta noslēpums (angļ. val. - secret);
4. Tālāk nepieciešams iestatīt OAuth Consent Screen. Jāpievērš īpaša uzmanība definētajam domēnam;
5. Veidojot aplikāciju, nepieciešams definēt Google_Client un veidu, kā tiks izgūta informācija par lietotāju.

Konfigurācija (Apraksta aplikācijas konfigurāciju, iestatot nepieciešamo info):
$clientID = '<YOUR_CLIENT_ID>';
$clientSecret = '<YOUR_CLIENT_SECRET>';
$redirectUri = '<REDIRECT_URI>';
Izveidot klienta pieprasījumu, lai piekļutu Google API:
$client = new Google_Client();
$client->setClientId($clientID);
$client->setClientSecret($clientSecret);
$client->setRedirectUri($redirectUri);

Pēc pieslēgšanās datu bazē būs pieejama informācija par konkrēto profilu
$client->addScope("email");
$client->addScope("profile");
Koda autentifikācija no Google OAuth:
if (isset($_GET['code'])) {
  $token = $client->fetchAccessTokenWithAuthCode($_GET['code']);
  $client->setAccessToken($token['access_token']);

Profila infomrācijas izgūšana:
$google_oauth = new Google_Service_Oauth2($client);
  $google_account_info = $google_oauth->userinfo->get();
  $email =  $google_account_info->email;
  $name =  $google_account_info->name;
  
