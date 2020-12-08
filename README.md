# filter-using-multi-providers
Challenge Description: https://bitbucket.org/parenthq/workspace/snippets/Lrgexj
solution description.

used: JWTAUTH package. composite design pattern. solid principles. unit testing.

please first you need to create 2 databases 1 for deploy set in .env another for testing and set in .env.testing. please sure you have 2 files in project (.env, .env.testing)

then do these commands : 1: composer install. 2: php artisan migrate --seed. 3: php artisan jwt:secret

note you need to login to generate tokin to do requests if you need to disable token please go to CompositeController and comment this line:      
$this->middleware('jwt.auth', ['only' => ['listData']]);

to test requests directory project has file: filterTask.postman_collection //import it in your postman and make test

note: please add permission to directory storage/providers // to make it readable

note:
    i used controller to get request then send it to service, 
    service use classes as need then call repository to manage database
     then return result last controller return response.

links API's: 
localhost/filter-using-multi-providers/public/api/auth/login
body: [{"key":"email","value":"amr@gmail.com","description":""},{"key":"password","value":"123456789","description":""}]
///
localhost/filter-using-multi-providers/public/api/v1/users?statusCode=authorised&balanceMin=10&balanceMax=280&provider=DataProviderX
header: [{"key":"Authorization","value":"bearer token","description":""},{"key":"Content-Type","value":"application/json","description":""}]
//
localhost/filter-using-multi-providers/public/api/v1/users
header: [{"key":"Authorization","value":"bearer token","description":""},{"key":"Content-Type","value":"application/json","description":""}]
