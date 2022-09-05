<div class='userProfile'>
    <div class='mb-3'>
        <div class='userGreet'> Hello, </div>
        <div class='userName'> {{ Session::get('user') }} </div>
    </div>
    <a href="/ppsi_crystalguesthouse/logout">
        <div class='userLogout'> Log out </div>
    </a>
</div>
