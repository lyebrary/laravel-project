<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EASEPASYO</title>

    @livewireStyles
</head>
<body>
    <form wire.submit.prevent="register">
        <div class="Last Name">
            <label>First Name</label>
            <input wire.model="form.first-name">
        </div>
        <div class="Last Name">
            <label>Last Name</label>
            <input wire.model="form.name">
        </div>
        <div class="name">
            <label>Full Name</label>
            <input wire.model="form.name">
        </div>
        <div class="name">
            <label>Full Name</label>
            <input wire.model="form.name">
        </div>
        <div class="name">
            <label>Full Name</label>
            <input wire.model="form.name">
        </div>
    </form>
    @livewireScripts
</body>
</html>