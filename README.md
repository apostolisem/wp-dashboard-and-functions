# Demo Company: Dashboard & Functions
![Plugin Preview](https://yourwebsite.com/tools/domains/plugin-preview3.jpg)

A WordPress Plugin to Replace the Default Admin Dashboard with a custom one and add Useful Functions for Demo Company Clients.

- Replace the original WordPress Dashboard with a Custom one
- Easy way to customize the plugin for your clients
- Send login alerts every time an Administrator logins
- Limit WordPress heartbeat to the minimum for server resources saving
- Disable WordPress Automatic Core Updates alerts

\* Please consider that some features may not have been implemented yet.

## Installation

1. Download the plugin from Github to your computer.
2. Go to WordPress admin area and visit Plugins » Add New page.
3. Click on the Upload Plugin button on top of the page and select the zip file of the plugin from your computer.
4. Click on the install now button.

WordPress will now upload the plugin file from your computer and install it for you. You will see a success message after the installation is finished. Press "Activate Plugin".

## Usage

The plugin is designed to work with our website "[yourwebsite.com](https://yourwebsite.com)" and our clients. This means that as soon as you upload it on your website, it will communicate with our API to find information about the domain is running from (one-way communication, we don't collect any data).

In order to use it for your own needs, alter the following variables in "plugin-settings.php" with your own data, now you can use it for your own clients.

```php
// edit your company info
$wpc['company_name'] = "Demo Company";
$wpc['company_website'] = "https://yourwebsite.com";
$wpc['company_email'] = "info@yourwebsite.com";
// api url to get the website information
$wpc['api_url'] = "https://your.api/url/here/json.php";
```

The **API** is easy to implement. At the moment, the plugin requests two types of data, **domain data** and **domain messages** to display on the dashboard.

### URL to request domain data:
```html
https://your.api/url/here/json.php?domain=client-domain.com&ver=1&action=data
```
#### The JSON output:
The plugin will recognize the following JSON output and will show the domain's data on client's dashboard.

```json
{"domain":"client-domain.com","dom_exp":"31-12-2020", 
"dom_renew":"https:\/\/yourwebsite.com\/","hosting":"Starter Hosting Plan, HDD 5GB, Bandwidth 50GB\/month", 
"hosting_exp":"31-12-2020","hosting_renew":"https:\/\/yourwebsite.com\/"}
```

### URL to get domain messages:
```html
https://your.api/url/here/json.php?domain=client-domain.com&ver=1&action=messages
```
#### The JSON output:
The plugin will recognize the following JSON output and will show the messages on client's dashboard.
```json
["10-01-2020:::The Message for our client.","11-01-2020:::Another Message for our client."]
```

## Contributing
Pull requests are welcome. For major changes, please open an issue first to discuss what you would like to change.

## License
[MIT License](https://choosealicense.com/licenses/mit/)

Copyright (c) 2020

Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the Software is
furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all
copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
SOFTWARE.
