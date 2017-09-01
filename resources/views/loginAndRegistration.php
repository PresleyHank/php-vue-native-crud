<ul class="tab-group">
    <li class="tab active"><a href="#signup">Sign Up</a></li>
    <li class="tab"><a href="#login">Log In</a></li>
</ul>

<div class="tab-content">
    <div id="signup">
        <h1>Sign Up</h1>
        <form id="registration" action="../../route/route.php" method="post">
            <div id="regErrors" class="registrationErrors">
                <?php @include('errors.php'); ?>
            </div>
            <div class="field-wrap">
                <div class="field-wrap">
                    <label>
                        Username<span class="req">*</span>
                    </label>
                    <input name="username" type="text" required autocomplete="off"/>
                </div>
            </div>

            <div class="field-wrap">
                <label>
                    Email Address<span class="req">*</span>
                </label>
                <input name="email" type="email" required autocomplete="off"/>
            </div>

            <div class="field-wrap">
                <label>
                    Set A Password<span class="req">*</span>
                </label>
                <input name="password" type="password" required autocomplete="off"/>
            </div>

            <div class="field-wrap">
                <label>
                    Type your password again<span class="req">*</span>
                </label>
                <input name="secondaryPassword" type="password" required autocomplete="off"/>
            </div>
            <input id='registrationRoute' name="route" type="hidden" value="registration"/>

            <button type="submit" class="button button-block">Get Started</button>

        </form>

    </div>

    <div id="login">
        <h1>Welcome Back!</h1>

        <form id="login" action="../../route/route.php" method="post">
            <div id="logErrors" class="loginErrors">
                <?php @include('errors.php'); ?>
            </div>
            <div class="field-wrap">
                <label>
                    Email Address or Username<span class="req">*</span>
                </label>
                <input name="usernameOrEmail" type="text" required autocomplete="off"/>
            </div>

            <div class="field-wrap">
                <label>
                    Password<span class="req">*</span>
                </label>
                <input name="password" type="password" required autocomplete="off"/>
            </div>

            <p class="forgot"><a href="#">Forgot Password?</a></p>

            <input id='loginRoute' name="route" type="hidden" value="login"/>

            <button type="submit" class="button button-block">Log In</button>

        </form>

    </div>

</div>