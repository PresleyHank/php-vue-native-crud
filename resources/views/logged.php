<ul class="tab-group">
    <li class="tab active"><a href="#logged">You are logged in, success! Click to more info!</a></li>
</ul>

<div class="tab-content">
    <div id="logged">
        <h1>Greetings! nice to see you here again!</h1>
        <form id="logoutForm" action="../../route/route.php" method="get">
            <input name="route" type="hidden" value="logout"/>
            <button type="submit" class="button button-block">Logout</button>
        </form>
    </div>
</div>