
<html>
<?php
require APPROOT . '/views/includes/header.php';
include APPROOT . '/views/includes/adminNav.php';
?>

<body>
<section>
    <form action="<?php echo URLROOT; ?>/danceAdmins/editArtist" method="post">
        <h2>Artist Page</h2>
        <label>Name</label>
        <?php if(isset($_GET['id'])){?>
            <input type="hidden" name="id" value='<?php echo $_REQUEST['id']?>'>
        <?php } ?>
        <input type="text" name="name" value='<?php echo $data['name']?>'>
        <label>Description</label>
        <aside>
            <textarea class="FormElement" name="description" cols="140" rows="10"><?php echo $data['description']?></textarea>
        </aside>
        <aside>
            <label>Genre</label>
            <input type="text" name="genre" value='<?php echo $data['genre']?>'>
        </aside>

        <aside>
            <label>Facebook Link</label>
            <input type="text" name="facebook" value='<?php echo $data['facebook']?>'>
        </aside>

        <aside>
            <label>Twitter Link</label>
            <input type="text" name="twitter" value='<?php echo $data['twitter']?>'>
        </aside>
        <aside>
            <label>Instagram Link</label>
            <input type="text" name="instagram" value='<?php echo $data['instagram']?>'>
        </aside>
        <aside>
            <label>Youtube Link</label>
            <input type="text" name="youtube" value='<?php echo $data['youtube']?>'>
        </aside>
        <button id="updateArtist" name="action" type="submit" value="updateArtist">Update Artist</button>
        <button id="insertDance" name="action" type="submit" value="insertDance">Create New Dance</button>
        <span class="invalidFeedback">
                    <?php echo $data['emptyFieldsErrors']; ?>
        </span>
    </form>
</section>
</body>
</html>
