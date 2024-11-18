<h1>Thêm danh mục</h1>
<form method="POST" action="<?php echo route("categories.add")  ?>">
    <div>
        <input type="text" name="categoryName" placeholder="Enter your category name">
        <?php 
            echo csrf_field()
        ?>
        <!-- <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>"> -->
    </div>
    <button type="submit"  style="height: 30px;width: 80px;padding: 4px;margin: 12px;">Submit</button>
</form>