OC.L10N.register(
	"twofactor_email",
	{
	// ADDITIONAL strings to be localized in appinfo/info.xml

	// lib/Provider/Email.php
	"Email" : "E-posta",
	"Send a code to your email address" : "E-posta adresinize bir kod gönderin",

	// lib/Service/Email.php
	"Login attempt for %s" : "%s için oturum açma girişimi",
	"Your two-factor authentication code is: %s" : "İki aşamalı kimlik doğrulama kodunuz: %s",
	"If you tried to login, please enter that code on %s. If you did not, somebody else did and knows your your email address or username – and your password!" : "Oturum açmayı denediyseniz, %s üzerinde bu kodu girin. Siz yapmadıysanız başka biri denedi ve e-posta adresinizi veya kullanıcı adınızı – ve parolanızı biliyor!",

	// src/components/GatewaySettings.vue
	"You need to set an email address in 'Personal info' first." : "Önce 'Kişisel bilgiler' bölümünde bir e-posta adresi ayarlamanız gerekir.",

	"Could not send a verification code via email. An Admin must set this up first." : "E-posta yoluyla bir doğrulama kodu gönderilemedi. Bu, önce bir Yönetici tarafından ayarlanmalıdır.",
	"Enable Two-Factor Authentication via Email" : "E-posta ile İki Faktörlü Kimlik Doğrulamayı Etkinleştirin",

	"The entered code does not match that sent to {emailAddress}." : "Girilen kod {emailAddress} adresine gönderilenle eşleşmiyor.",
	"A code has been sent to {emailAddress}." : "{emailAddress} adresine bir kod gönderildi.",
	"Verify code" : "Kodu doğrula",
	"Cancel activation" : "Etkinleştirmeyi iptal et",

	"Two-Factor Authentication via Email is enabled. Codes are sent to {emailAddress}." : "E-posta ile İki Faktörlü Kimlik Doğrulama etkinleştirildi. Kodlar {emailAddress} adresine gönderiliyor.",
	"Disable Two-Factor Authentication via Email" : "E-posta ile İki Faktörlü Kimlik Doğrulamayı Devre Dışı Bırakma",

	// templates/error.php
	"Error while sending the email. Please try again later or ask your administrator." : "E-posta gönderilirken hata oluştu. Lütfen daha sonra tekrar deneyin veya yöneticinize danışın.",

	// templates/challenge.php
	"A code has been sent to your email address." : "E-posta adresinize bir kod gönderildi.",
	"Authentication code" : "Kimlik doğrulama kodu",
	"Submit" : "Gönder",
},
"");
