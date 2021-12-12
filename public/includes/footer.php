<link rel="stylesheet" href="css/footer.css">

<footer id="footer">
    <div class="footer__content">
        <div class="footer__us footer_item">
            <p class="footer__title">
                <?php echo $i18n->footer->about->title ?>
            </p>
            <div class="footer__body">
                <p class="footer__body__content">
                    <?php echo $i18n->footer->about->body ?>
                </p>
            </div>
        </div>
        <div class="footer__contact footer_item">
            <p class="footer__title">
                <?php echo $i18n->footer->contacts->title ?>
            </p>
            <div class="footer__body">
                <p class="footer__body__title"><?php echo $i18n->footer->contacts->address->title ?></p>
                <p class="footer__body__content"><?php echo $i18n->footer->contacts->address->body ?></p>
            </div>
            <div class="footer__body">
                <p class="footer__body__title"><?php echo $i18n->footer->contacts->phone->title ?></p>
                <p class="footer__body__content"><?php echo $i18n->footer->contacts->phone->body ?></p>
            </div>
            <div class="footer__body">
                <p class="footer__body__title"><?php echo $i18n->footer->contacts->email->title ?></p>
                <p class="footer__body__content"><?php echo $i18n->footer->contacts->email->body ?></p>
            </div>
        </div>
        <div class="footer__social_media footer_item">
            <p class="footer__title"><?php echo $i18n->footer->socials->title ?></p>
            <div class="footer__body">
                <div class="footer__body">
                    <a class="footer__body__link" href="https://facebook.com">Facebook</a>
                </div>
                <div class="footer__body">
                    <a class="footer__body__link" href="https://twitter.com">Twitter</a>
                </div>
                <div class="footer__body">
                    <a class="footer__body__link" href="https://instagram.com">Instagram</a>
                </div>
            </div>
        </div>
    </div>
</footer>