<footer class="p-16 xl:py-25 xl:px-32 text-sm">
    <div class="container">
        <div class="flex flex-wrap justify-center items-center text-center gap-x-10">
            <span>
                <?= $site->copyright() ?>
            </span>
            <a href="<?= $site->imprint_link_field()->toUrl() ?>" class="underline">
                Imprint
            </a>
        </div>
    </div>
</footer>
<?= js([
    'assets/js/gsap.min.js',
    'assets/js/script.js'
]) ?>
</body>

</html>