</div> 
</div>
</div>     
</div>  

<script src="<?= BASEURL; ?>/js/toast.js"></script>
<script src="<?= BASEURL; ?>/js/script.js"></script>
<?php if (Flasher::has("msg_success")) : ?>
    <script>
        createToast("<?= Flasher::get("msg_success") ?>", "success")
    </script>
<?php endif ?>

<?php if (Flasher::has("msg_error")) : ?>
    <script>
        createToast("<?= Flasher::get("msg_error") ?>", "error")
    </script>
<?php endif ?>

</body>
</html>