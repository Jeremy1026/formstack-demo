# formstack-demo
Demo Formstack Software Engineer Assignment


## Basic Usage 
Access at testbox.dev after initiating Vagrant.

You will initially be presented with an empty table with a single "Create New!" button. To add a new user click "Create New!" and fill in all of the information and select "Create User". The table will then update to reflect your new user. You can then choose to Edit or Delete that user by clicking the appropriate links next to the user record in the table.


## Api
A basic REST API end point exists at:

```
testbox.dev/api
```

### Valid API Endpoints

 * /getUsers
 * /getUserByID
 * /updateUser
 * /createUser
 * /deleteUser

#### /getUsers

Returns a JSON encoded list of all current users.

### /getUsersByID

#### Method: POST

#### Example POST Data

```
{'id': 1}
```

Returns a JSON encoded array of the requested user.

### /updateUser

#### Method: POST

#### Example POST Data


```
{'id': 1,
 'firstName: 'Foo',
 'lastName: 'Bar'
 'email': 'foo@bar.com'
 'password': 'securepassword'}
```

Updates a user with the corresponding ID with the provided information.

### /createUser

#### Method: POST

#### Example POST Data


```
{'firstName: 'Foo',
 'lastName: 'Bar'
 'email': 'foo@bar.com'
 'password': 'securepassword'}
```

Creates a new user with the provided information.

### /deleteUser

#### Method: POST

#### Example POST Data


```
{'id': 1}
```

Deletes the user with the corresponding ID.