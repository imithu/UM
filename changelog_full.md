## [🔖 Version 2.4.1](https://github.com/imithu/UM-Laravel/releases/tag/v2.4.0) - 🇧🇩 UTC+6 2021-June-29 05:27:42
### 🚩 Fix
- 🐛 fix - add htmlspecialchars_decode in get_text method of UM\User\Meta class




## [🔖 Version 2.4.0](https://github.com/imithu/UM-Laravel/releases/tag/v2.4.0) - 🇧🇩 UTC+6 2021-June-28 23:39:10
### 🚩 Added
- Profile class




## [🔖 Version 2.3.0](https://github.com/imithu/UM-Laravel/releases/tag/v2.3.0) - 🇧🇩 UTC+6 2021-May-18 12:48:12
### 🚩 Added
- Meta class




## [🔖 Version 2.2.0](https://github.com/imithu/UM-Laravel/releases/tag/v2.2.0) - 🇧🇩 UTC+6 2021-May-17 17:22:49
### 🚩 Improved
- main method of Login class
- main method of authentication class




# [Version 2.1.0](https://github.com/imithu/UM-Laravel/releases/tag/v2.1.0) - UTC 2021-May-11 08:08:08
## Improved
- optional key feature is added in JWT encode method




# [Version 2.0.0](https://github.com/imithu/UM-Laravel/releases/tag/v2.0.0) - UTC 2021-May-07 05:33:36
## Improved
- UM\User\Account class
- UM\User\Login class
- UM\User\Authentication class
- UM\User\Register class
- UM\Verify\Google class
## Added
- UM\User\Password::update method
## Removed
- removed all classes of UM\Database
- UM\User\Password::password_reset_request method
- UM\User\Password::password_update method
- UM\Verify\Syntax::password method
- UM\Verify\User class




# [Version 1.11.0](https://github.com/imithu/UM-Laravel/releases/tag/v1.11.0) - UTC 2021-Apr-08 23:10:16
## Fixed
in UM/Database/Users.php,
- datatype error of id_username method
- datatype error of id_email method
- datatype error of id_username_or_email method





# [Version 1.10.0](https://github.com/imithu/UM-Laravel/releases/tag/v1.10.0) - UTC 2021-Mar-27 09:30:02
## Added
- JWT encode
- JWT decode
## Improved
- Generate Unknown_Data
- Usermeta method in UM\Database
## Rename
- from register_main to main in UM\User\register
## Removed
- current_user_id form UM\User\Account
- usertype method from UM\User\Account



# [Version 1.9.0](https://github.com/imithu/UM-Laravel/releases/tag/v1.9.0) - UTC 2021-Mar-18 16:46:36
## Improved
- Authentication main is improved




# [Version 1.8.0](https://github.com/imithu/UM-Laravel/releases/tag/v1.8.0) - UTC 2021-Mar-17 04:08:13
## Added
- Login
## Improved
- Authentication




# [Version 1.7.0](https://github.com/imithu/UM-Laravel/releases/tag/v1.7.0) - UTC 2021-Mar-15 16:49:52
## Added
- Authentication

## Removed
- Login
- Logout

# Improved
- Register


# [Version 1.6.0](https://github.com/imithu/UM-Laravel/releases/tag/v1.6.0) - 2021-Feb-10
## Added
- unique parameter has been added in insert method


# [Version 1.5.0](https://github.com/imithu/UM-Laravel/releases/tag/v1.5.0) - 2021-Feb-10
## Removed
- unnecessary codes of General_country has been removed


# [Version 1.4.1](https://github.com/imithu/UM-Laravel/releases/tag/v1.4.1) - 2021-Feb-09
## Improved
- random_name method will now replace html special chars


# [Version 1.4.0](https://github.com/imithu/UM-Laravel/releases/tag/v1.4.0) - 2021-Feb-09
## Added
- usertype method has been added


# [Version 1.3.1](https://github.com/imithu/UM-Laravel/releases/tag/v1.3.1) - 2021-Jan-26
## Fixed
- login does not working sometimes


# [Version 1.3.0](https://github.com/imithu/UM-Laravel/releases/tag/v1.3.0) - 2021-Jan-26
## Changed
- security has improved for random_name method


# [Version 1.2.0](https://github.com/imithu/UM-Laravel/releases/tag/v1.2.0) - 2021-Jan-26
## Changed
- security has improved for register_main method


# [Version 1.1.0](https://github.com/imithu/UM-Laravel/releases/tag/v1.1.0) - 2021-Jan-26
## Changed
- username verify method has improved


# [Version 1.0.1](https://github.com/imithu/UM-Laravel/releases/tag/v1.0.1) - 2021-Jan-18
## Removed
- unnecessary code


# [Version 1.0.0](https://github.com/imithu/UM-Laravel/releases/tag/v1.0.0) - 2021-Jan-18
## Added
- Unknown_data class
- Modify_Data class
- Syntax class
- User class
- Google class

## Changed
- Account class
- Register class
- Login class
- Password class
- Logout class
- Options class
- General class
- Usermeta class
- Users class

## Removed
- Common class
- Document class
- Dynamic_Data class
- Valid class
- Config class


## Thank you very much