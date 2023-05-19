<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Authentication Defaults
    |--------------------------------------------------------------------------
    |
    | Esta opción controla la "guard" de autenticación predeterminada y las opciones de restablecimiento de contraseña 
    | para su aplicación. Puede cambiar estas opciones según sea necesario, pero son un buen comienzo para la mayoría 
    | de las aplicaciones.
    |
    */

    'defaults' => [
        'guard' => 'web', //Guardia web predeterminado
        'passwords' => 'users', //Proveedor de contraseñas de usuario predeterminado
    ],

    /*
    |--------------------------------------------------------------------------
    | Authentication Guards
    |--------------------------------------------------------------------------
    |
    | A continuación, puede definir cada guardia de autenticación para su aplicación.
    | Por supuesto, se ha definido una excelente configuración predeterminada para usted
    | aquí que utiliza el almacenamiento de sesión y el proveedor de usuarios Eloquent.
    |
    | Todos los controladores de autenticación tienen un proveedor de usuarios. Esto define cómo
    | los usuarios se recuperan realmente de su base de datos u otros medios de almacenamiento
    | utilizado por esta aplicación para persistir los datos de sus usuarios.
    |
    | Soportado por autenticación por sesión.
    |
    */

    'guards' => [
        'web' => [
            'driver' => 'session', //Driver de sesión
            'provider' => 'users', //Proveedor de usuarios predeterminado
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | User Providers
    |--------------------------------------------------------------------------
    |
    | Todos los controladores de autenticación tienen un proveedor de usuarios. Esto define cómo
    | los usuarios se recuperan realmente de su base de datos u otros medios de almacenamiento
    | utilizado por esta aplicación para persistir los datos de sus usuarios.
    |
    | Si tiene varias tablas o modelos de usuarios, puede configurar múltiples
    | fuentes que representen cada modelo / tabla. Estas fuentes luego pueden
    | asignarse a cualquier guarda adicional de autenticación que haya definido.
    |
    | Soportado por "database", "eloquent".
    |
    */

    'providers' => [
        'users' => [
            'driver' => 'eloquent', //Proveedor de usuarios basado en Eloquent
            'model' => App\Models\User::class, //Modelo usuario predeterminado
        ],

        /* 'users' => [
            'driver' => 'database', //Proveedor de usuarios basado en base de datos
            'table' => 'users', //Tabla de usuario predeterminada
        ], */
    ],


    /*
    |--------------------------------------------------------------------------
    | Resetting Passwords
    |--------------------------------------------------------------------------
    |
    | You may specify multiple password reset configurations if you have more
    | than one user table or model in the application and you want to have
    | separate password reset settings based on the specific user types.
    |
    | The expiry time is the number of minutes that each reset token will be
    | considered valid. This security feature keeps tokens short-lived so
    | they have less time to be guessed. You may change this as needed.
    |
    | The throttle setting is the number of seconds a user must wait before
    | generating more password reset tokens. This prevents the user from
    | quickly generating a very large amount of password reset tokens.
    |
    */

    'passwords' => [
        'users' => [
            'provider' => 'users',
            'table' => 'password_reset_tokens',
            'expire' => 60,
            'throttle' => 60,
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Password Confirmation Timeout
    |--------------------------------------------------------------------------
    |
    | Here you may define the amount of seconds before a password confirmation
    | times out and the user is prompted to re-enter their password via the
    | confirmation screen. By default, the timeout lasts for three hours.
    |
    */

    'password_timeout' => 10800,

];
