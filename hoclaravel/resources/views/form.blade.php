<form method="POST" action="/unicode">
    <div>
        <input type="text" name="username" placeholder="Enter your name">
        <input type="hidden" name="_method" value="DELETE">
        <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
    </div>
    <button type="submit"  style="height: 30px;width: 80px;padding: 4px;margin: 12px;">Submit</button>
</form>