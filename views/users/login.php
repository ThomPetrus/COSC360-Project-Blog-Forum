<div id="js-msg"></div>
<div class="panel panel-default login-panel">
    <div class="panel-heading">
        <h3 class="panel-title">LOG INTO ·B·O·T·</h3>
    </div>
    <div class="panel-body login-panel-body">
        <form method="POST" action="<?php $_SERVER['PHP_SELF']?>" enctype="multipart/form-data">
            <div class="form-group">
                <input id="email" type="email" name="email" class="form-control" placeholder="Email"
                    onchange="javascript:validateEmail(this.value)" required>
            </div>
            <div class="form-group">
                <input id="pw" type="password" name="pw" class="form-control" placeholder="Password" required />
            </div>
            <input class="btn btn-light portfolio-btn" id="sign-in-button" name="submit" type="submit"
                value="·LOG IN·" />
        </form>
        <a class="btn btn-light portfolio-btn" id="forgot-pass-btn">·FORGOT PASSWORD·</a>
    </div>

    <div class="forgot-pass-form form-group">
        <form method="POST" action="<?php $_SERVER['PHP_SELF']?>/users/forgotPass" enctype="multipart/form-data">
            <input class="form-control" type="text" name="email" placeholder="Enter Email">
            <input class="btn btn-light portfolio-btn" type="submit" value="submit" name="submit">
        </form>
    </div>

</div>