<div class="panel panel-default forum-content-container">
    <div class="panel-heading">
        <h3 class="lead">·Register·</h3>
    </div>
    <div class="panel-body">
        <form method="POST" action="<?php $_SERVER['PHP_SELF']?>" enctype="multipart/form-data">
            <div class="form-group">
                <input type="text" name="fname" class="form-control" placeholder="First Name" required />
            </div>
            <div class="form-group">
                <input type="text" name="lname" class="form-control" placeholder="Last Name" required />
            </div>
            <div class="form-group">
                <input id="email" type="email" name="email" class="form-control" placeholder="Email"
                    onchange="javascript:validateEmail(this.value)" required>
            </div>
            <div class="form-group">
                <input id="pw" type="password" name="pw" class="form-control" placeholder="Password"
                    onchange="javascript:validatePW(this.value)" required />
            </div>
            <div class="form-group">
                <input id="confirmPw" type="password" name="confirmPw" class="form-control"
                    placeholder="Confirm Password" onchange="javascript:validateConfirmPW(this.value)" required />
            </div>
            <div class="form-group">
                <input type="text" name="edu" class="form-control" placeholder="Education" required />
            </div>
            <div class="form-group">
                <input type="text" name="job" class="form-control" placeholder="Job" required />
            </div>
            <input class="btn btn-secondary login-button" id="sign-in-button" name="submit" type="submit" value="·REGISTER·" />
        </form>
    </div>
</div>