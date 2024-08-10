# Custom Captive Portal with User Registration for pfSense

This project provides a custom captive portal for pfSense, featuring a user registration system. Users can log in with existing credentials or register a new account directly from the portal.

## Features

- **User Login:** Users can log in using their username and password.
- **User Registration:** New users can register by providing a username, password, email, and a registration PIN.
- **pfSense REST API Integration:** Utilizes the pfSense REST API by [jaredhendrickson13](https://github.com/jaredhendrickson13/pfsense-api) for user management.
- **Simple and Intuitive UI:** Clean and responsive design with an easy-to-use interface.

## Screenshots

### Login Screen

![Login Screen](images/login.png)

### Registration Screen

![Registration Screen](images/register.png)

## Installation

1. **Download and Upload Files:**
   - Clone the repository or download the files manually.
   - Upload the `html.php` and `error.php` files to your pfSense captive portal directory.

2. **API URL Configuration:**
   - Modify the `html.php` file to set the correct API URL.
   - The default URL is set to `http://10.5.48.1/api/v2/user`. You need to replace `10.5.48.1` with your pfSense device's IP address.
   - The API URL can be found in your pfSense API section.

3. **Basic Authentication Token:**
   - Update the basic authentication token in the `html.php` file.
   - Locate the line: `"Authorization: Basic YWRtaW46QWRtaW5AMTIz"`.
   - Replace the encoded token with your own. You can generate the token by encoding your `username:password` pair in Base64.

4. **Hardcoded PIN (Optional):**
   - The registration process uses a hardcoded PIN (`2222` by default).
   - If you wish to change this PIN, modify the `$hardcoded_pin` variable in the `html.php` file.

5. **Activate Captive Portal:**
   - Enable the captive portal in your pfSense settings.
   - Make sure to point the captive portal to the uploaded `html.php` file.

## Usage

- **Login:** Users can log in by entering their username and password.
- **Register:** New users can register by filling out the registration form with a valid PIN.

## Troubleshooting

- If the registration fails, users will be prompted with error messages, such as "Invalid PIN" or "Error while creating user." Ensure that the username does not contain spaces or special characters.

## Credits

- **pfSense REST API:** This project uses the pfSense REST API by [jaredhendrickson13](https://github.com/jaredhendrickson13/pfsense-api).

## License

This project is licensed under the GNU General Public License v3. See the [LICENSE](LICENSE) file for more details.

## Support

If you encounter any issues or have questions, feel free to reach out via Instagram: [@xdyogesh](https://www.instagram.com/xdyogesh).
