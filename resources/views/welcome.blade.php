<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>ICheck</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="shortcut icon" href="{{asset('Thumb/iChecklogo.png')}}">
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    <!-- Styles -->
    <link rel="stylesheet" href="{{asset('css/index.css')}}">
    <link rel="stylesheet" href="{{asset('bootstrap/css/bootstrap.min.css')}}">
    <script src="{{asset('bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <link rel="stylesheet" href="{{asset('css/buttons.dataTables.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/dataTables.min.css')}}">

    <script src="{{asset('js/jquery.js')}}"></script>
    <script src="{{asset('js/excel.js')}}"></script>
    <script src="{{asset('js/jquery.table2excel.js')}}"></script>
    <script src="{{asset('js/dataTables.min.js')}}"></script>


</head>

<body class="font-sans antialiased dark:bg-black dark:text-white/50">
    <div className="bg-gray-50 text-black/50 dark:bg-black dark:text-white/50">
        <!-- <img id="background" class="absolute top-0 max-w-[877px]" src="{{asset('Thumb/backgroudIcheck.png')}}" /> -->
        <div class="relative min-h-screen flex flex-col items-center justify-center selection:bg-[#FF2D20] selection:text-white">
            <div class="relative w-full max-w-2xl px-6 lg:max-w-7xl">
                <header class="grid grid-cols-2 items-center gap-2 lg:grid-cols-3">
                    <div class="flex lg:justify-center lg:col-start-2">
                        <img src="{{asset('Thumb/iCheck.png')}}" style="width:70%" alt="logo">
                    </div>
                </header>
                <main>
                    <div class="flex" style="flex-wrap: wrap;">
                        <div class="col-12 col-lg-8" style="padding: 1rem 5px 0 5px;">
                            <div class="boxshadowi card" style="width: 100%;padding:5px;min-height:500px;">
                                <div class="tableCheck col-12">
                                    <div style="display: flex;">
                                        <input class="addmail" type="email" style="display: none;color: #5e6af7" placeholder="Email">
                                        <button id="addRow" class="codepro-custom-btn codepro-btn-13">Add row</button>
                                        <div class="form-group">
                                            <label for="fileupload" class="codepro-custom-btn codepro-btn-13" style="text-align: center;">
                                                Upload file
                                            </label>
                                            <input id="fileupload" type="file" name="files[]" />
                                        </div>
                                    </div>
                                    <table id="example" class="table display nowrap" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>Id</th>
                                                <th>Email</th>
                                                <th>Verify</th>
                                            </tr>
                                        </thead>
                                        <tbody class="bodytable">
                                        </tbody>
                                    </table>
                                </div>
                                <div class="docCheck col-12" style="display:none; height: 500px;  overflow-y: scroll;">
                                    <h1 style="text-align:center;font-weight: 700">Document</h1>
                                    <div class="DocView" data-id="1">
                                        <h2>Introduce</h2>
                                        <p>-ICheck is a program that verifies the validity of email addresses, built on the PHP framework Laravel, with contributions from nt041.</p>
                                        <p>-In today's digital age, the use of fake emails for fraudulent activities is becoming increasingly common. Particularly, e-commerce users and online sellers often encounter spam emails, scams, or emails from unidentified sources, causing annoyance and wasting time.</p>
                                        <p>-ICheck was created to distinguish between valid email addresses and unreliable ones. The program is capable of verifying the authenticity of email addresses, helping users eliminate fake, spam, or potentially fraudulent emails.</p>
                                        <p>-For users, especially businesses and sellers, ICheck provides significant benefits by enhancing information security and minimizing risks of loss or fraud. By filtering out unwanted and illegal emails, they can focus on interacting with genuine customers and building long-term customer relationships in a safer and more efficient manner.</p>
                                    </div>
                                    <div class="DocView" style="display: none;" data-id="2">
                                        <h2>Installation Instructions</h2>
                                        <h3>Install Laravel Guide</h3>

                                        <h4>1. System Requirements</h4>

                                        <h5>PHP</h5>
                                        <p>Laravel requires PHP version 7.3 or higher. You can check your current PHP version by opening a terminal and running the command:</p>
                                        <code>php --version</code>
                                        <p>If your PHP version doesn't meet the requirements, you'll need to install or update PHP. You can use installation packages like XAMPP, WAMP, or install PHP directly from the official PHP website.</p>

                                        <h5>Composer</h5>
                                        <p>Composer is a PHP dependency manager widely used in the PHP community to manage and install dependencies. Make sure you have Composer installed on your system before proceeding.</p>

                                        <h5>Code Editor</h5>
                                        <p>A code editor is necessary for editing Laravel source code. There are many options for code editors such as Visual Studio Code, PhpStorm, Sublime Text, and many more. Choose a code editor you prefer and install it on your system.</p>

                                        <h4>2. Installing Composer</h4>

                                        <h5>Windows</h5>
                                        <ol>
                                            <li>Download Composer-Setup.exe from the <a href="https://getcomposer.org/download/">Composer website</a>.</li>
                                            <li>Run the exe file and follow the steps in the installer.</li>
                                            <li>Once the installation is complete, open a terminal window and check Composer by running the command <code>composer --version</code>.</li>
                                        </ol>

                                        <h5>MacOS</h5>
                                        <ol>
                                            <li>Open a terminal and run the following command to download Composer to your system:</li>
                                            <pre>php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"</pre>
                                            <li>Next, run the following command to install Composer:</li>
                                            <pre>php composer-setup.php --install-dir=/usr/local/bin --filename=composer</pre>
                                            <li>Check if Composer has been successfully installed by running the command <code>composer --version</code>.</li>
                                        </ol>

                                        <h5>Linux</h5>
                                        <ol>
                                            <li>Open a terminal and run the following commands to download and install Composer:</li>
                                            <pre>php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"</pre>
                                            <pre>sudo php composer-setup.php --install-dir=/usr/local/bin --filename=composer</pre>
                                            <li>Check if Composer has been successfully installed by running the command <code>composer --version</code>.</li>
                                        </ol>

                                        <p>After successfully installing Composer, you're ready to start creating a new Laravel project and developing your web application.</p>
                                        <h3>ICheck Installation Guide</h3>

                                        <h4>1. Download ICheck</h4>
                                        <p>Visit the official website or repository of ICheck and download the latest version of the source code.</p>

                                        <h4>2. Extract the Files</h4>
                                        <p>After downloading, extract the zip or tar.gz file of ICheck into a folder on your computer.</p>

                                        <h4>3. Run Missing Files</h4>
                                        <p>Before you can run the application, you need to install the dependencies using Composer. Open a terminal and navigate to the directory containing the source code of ICheck. Then, run the following command:</p>
                                        <pre><code>composer install</code></pre>
                                        <p>This command will download and install all the necessary dependencies for ICheck.</p>

                                        <h4>4. Run the Application</h4>
                                        <p>After installing the dependencies, you can run the ICheck application using PHP's built-in server. Navigate to the root directory of the application and run the following command:</p>
                                        <pre><code>php artisan serve</code></pre>
                                        <p>This command will start the development server on the default port 8000. You can access your application by opening a web browser and entering the URL <code>http://localhost:8000</code>.</p>

                                        <p>These are the basic steps to install and run ICheck on your computer. Note that before running the application in a production environment, you need to configure and optimize your server and application properly.</p>


                                    </div>
                                    <div class="DocView" style="display: none;" data-id="3">
                                        <h2>Function list</h2>
                                        <h3>Add Row:</h3>
                                        <p>When users hover over a specific area or click on a button, a field to enter an email address will appear. After the user enters an email address and if the email address is determined to be valid, the email information will be added to a new row in the data table displayed on the page.</p>
                                        <hr>
                                        <h3>Upload File:</h2>
                                            <p>The system is designed to allow users to upload and add multiple files at once to the data table below. However, an important factor to note is that each file should only contain one line, which includes email information. This ensures that the data added to the table adheres to the correct format and helps ensure accurate information processing. Adhering to this structure is necessary to avoid compatibility issues and to maintain consistency and easy data management within the system.</p>
                                            <hr>
                                            <h3>Search:</h3>
                                            <p>Search for entered emails.</p>
                                            <hr>
                                            <h3>Check:</h3>
                                            <p>
                                                When checking emails using an asynchronous mechanism, the system will perform a one-time check of the email for correct syntax before proceeding to verify the email. Note that email checking only applies to providers other than Yahoo. The results of the check will be returned in three scenarios:</p>
                                            <ul>
                                                <li>Correct emails will be displayed in blue.</li>
                                                <li>Incorrect emails will be displayed in red.</li>
                                                <li>Correct but insecure emails will be displayed in yellow.</li>
                                            </ul>
                                            <hr>
                                            <h3>Save:</h3>
                                            <p>Save the verified emails as an Excel file. After the check process, the system will aggregate all valid email addresses and save them as an Excel file. This Excel file will contain information about the verified emails and be ready for use. This provides a convenient and intuitive way to manage, store, and use email addresses effectively.</p>
                                            <hr>
                                            <h3>All:</h3>
                                            <p>View all emails.</p>

                                            <h3>True:</h3>
                                            <p>View verified emails.</p>

                                            <h3>False:</h3>
                                            <p>View unverified emails.</p>
                                            <hr>
                                            <h3>Document:</h3>
                                            <ul>
                                                <li>Introduction: Display introduction information.</li>
                                                <li>Settings: Display settings options.</li>
                                                <li>Features: Display features overview.</li>
                                            </ul>
                                            <hr>
                                            <h3>Check Email:</h3>
                                            <ul>
                                                <li>Check: Perform email verification.</li>
                                                <li>Save: Save verified emails.</li>
                                                <li>View: View email details.</li>
                                                <li>Clear: Clear email data.</li>
                                            </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-lg-4" style="padding: 1rem 5px 0 5px">
                            <div class="col-12 card clicktable boxshadowi listcat" style="margin-bottom: 10px;">
                                <div class="cate1">
                                    <h3>Check email</h3>
                                    <button class="codepro-custom-btn codepro-btn-13 CheckEmail col-10 m-1">Check</button>
                                    <div style="display: flex;justify-content: center">
                                        <button class="codepro-custom-btn codepro-btn-13 SaveEmail col-4 m-1">Save</button>
                                        <button class="codepro-custom-btn codepro-btn-13 EmailVery col-4 m-1">All</button>
                                        <button class="codepro-custom-btn codepro-btn-13 Clear col-3 m-1">Clear</button>
                                    </div>

                                </div>
                                <div class="cate2" style="display: none;">
                                    <h1>CHECK EMAIL</h1>
                                </div>
                            </div>
                            <div class="col-12 card clickdoc boxshadowi listcat" data-id='2'>
                                <div class="cat1" style="display: none;">
                                    <h3>Document</h3>
                                    <button class="codepro-custom-btn codepro-btn-13 checkdoc" data-id="1">Introduce</button>
                                    <button class="codepro-custom-btn codepro-btn-13 checkdoc" data-id="2">Install</button>
                                    <button class="codepro-custom-btn codepro-btn-13 checkdoc" data-id="3">Function</button>
                                </div>
                                <div class="cat2">
                                    <h1>DOCUMENT</h1>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
                <div>
                    <div id="text" data-text="ICHECK AUTHENTICATE ALL EMAILS">
                        ICHECK AUTHENTICATE ALL EMAILS
                    </div>
                </div>

            </div>
        </div>
    </div>
    <script src="{{asset('js/checkemail.js')}}"></script>
</body>

</html>