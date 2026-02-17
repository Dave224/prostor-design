<?php

use Components\ThemeSettings\ThemeSettingsFactory;
use Helpers\GoogleRecaptchaVerify;

$Theme = ThemeSettingsFactory::create();
?>

<?php if ($Theme->isRecaptchOnAndSet()) { ?>
    <script src="https://www.google.com/recaptcha/api.js?render=<?= $Theme->getRecaptchaSiteKey(); ?>"></script>
    <script>
        grecaptcha.ready(function() {
            grecaptcha.execute('<?= $Theme->getRecaptchaSiteKey(); ?>', {
                action: 'homepage'
            })
                .then(function(token) {
                    tokenInputs = document.querySelectorAll(".<?= GoogleRecaptchaVerify::INPUT_NAME ?>");
                    tokenInputs.forEach((tokenInput) => {
                        tokenInput.value = token;
                    });
                });
        });
    </script>
<?php } ?>
