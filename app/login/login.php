<div class="login-container">

    <div class="mask"></div>

    <form class="login-form" ng-controller="npLoginCtrl">
        <div class="project-logo"></div>

        <img src="assets/images/nine-pixels-cms.png" alt="Nine Pixels CMS" />

        <div class="input-container">
            <input type="text" name="email" ng-model="data.email" placeholder="Email" />
        </div>

        <div class="input-container">
            <input type="password" name="password" ng-model="data.password" placeholder="Password" />
        </div>

        <div class="login-controller">
            <input type="checkbox" ng-model="data.stayloggedin" value="true"><label>Stay logged in</label>
            <a href="#" class="pull-right">Forgot password?</a>
        </div>

        <div class="button-container align-center">
            <button class="btn" ng-click="login(data)">Log In</button>
        </div>
    </form>

    <div class="powered-by">
        <span>Powered by</span>
        <img src="assets/images/nine-pixels-logo.png" alt="Nine Pixels Logo" />
    </div>

</div>

<?php
if (!isset($_COOKIE['user'], $_COOKIE['sec_session_id'])) {
    echo '<script type="text/javascript" src="angular/ninepixels-core.min.js"></script>';
}