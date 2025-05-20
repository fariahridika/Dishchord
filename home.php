<?php
session_start();

if (isset($_SESSION['id']) && isset($_SESSION['fname'])) {
    include "db_conn.php";
    include 'php/User.php';
  
    $user = getUserById($_SESSION['id'], $conn);
    $recipes="";
    

    
    include "template/user_header.php";
?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Dashboard - <?= $user['fname'] ?></title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
        <link rel="stylesheet" type="text/css" href="css/style.css">
        <meta content="width=device-width, initial-scale=1.0" name="viewport">
        <meta content="" name="keywords">
        <meta content="" name="description">
        <!-- Favicon -->
        <link href="img/favicon.ico" rel="icon">

        <!-- Google Web Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;600&family=Nunito:wght@600;700;800&family=Pacifico&display=swap" rel="stylesheet">

        <!-- Icon Font Stylesheet -->
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

        <!-- Libraries Stylesheet -->
        <link href="lib/animate/animate.min.css" rel="stylesheet">
        <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
        <link href="lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css" rel="stylesheet" />

        <!-- Customized Bootstrap Stylesheet -->
        <link href="css/bootstrap.min.css" rel="stylesheet">


        <!-- Template Stylesheet -->
        <link href="css/style.css" rel="stylesheet">
        <style></style>
        <style>
            /* Dashboard specific styles */

            .dashboard-container .hero-header {
                background: linear-gradient(rgba(15, 23, 43, .9), rgba(15, 23, 43, .9)), url('img/bg-hero.jpg');
                background-position: center center;
                background-repeat: no-repeat;
                background-size: cover;
            }

            .dashboard-container .recipe-card {
                position: relative;
                overflow: hidden;
                border-radius: 15px;
                box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
                margin-bottom: 20px;
                aspect-ratio: 16 / 9;
                width: 400px;
                /* Maintain a consistent aspect ratio */
            }

            .dashboard-container .recipe-card img {
                width: 100%;
                height: 100%;
                object-fit: cover;
                object-position: center;
                transition: transform 0.3s ease;
            }

            .dashboard-container .recipe-card:hover img {
                transform: scale(1.1);
            }

            .dashboard-container .recipe-card .overlay {
                position: absolute;
                bottom: 0;
                left: 0;
                right: 0;
                background-color: rgba(0, 0, 0, 0.7);
                overflow: hidden;
                width: 100%;
                height: 100%;
                opacity: 0;
                transition: opacity 0.3s ease;
            }

            .dashboard-container .recipe-card:hover .overlay {
                opacity: 1;
            }

            .dashboard-container .recipe-card .text {
                color: white;
                font-size: 20px;
                position: absolute;
                top: 50%;
                left: 50%;
                transform: translate(-50%, -50%);
                text-align: center;
                width: 100%;
            }

            .dashboard-container .profile-section {
                background-color: #f8f9fa;
                border-radius: 15px;
                box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            }

            .buddy-button {
                background-color: blue;
                border: none;
                /* Remove borders */
                color: white;
                /* White text */
                padding: 10px 20px;
                /* Some padding */
                text-align: center;
                /* Centered text */
                text-decoration: none;
                /* Remove underline */
                display: inline-block;
                /* Make the button inline */
                margin: 4px 2px;
                /* Some margin */
                cursor: pointer;
                /* Pointer/hand icon */
                border-radius: 50px;
                /* Rounded corners */
                font-size: 16px;
                /* Increase font size */
            }

            .popup {
                display: none;
                position: fixed;
                top: 50%;
                left: 50%;
                transform: translate(-50%, -50%);
                background-color: white;
                padding: 20px;
                border: 1px solid #ccc;
                z-index: 1000;
                max-height: 80vh;
                overflow-y: auto;
                width: 80%;
                max-width: 600px;
            }

            #closePopup {
                margin-top: 10px;
                padding: 5px 10px;
                background-color: #dc3545;
                color: white;
                border: none;
                border-radius: 4px;
                cursor: pointer;
            }

            #closePopup:hover {
                background-color: #c82333;
            }
        </style>
    </head>

    <body>

        <div class="container-fluid hero-header py-5 mb-5">
            <div class="container text-center my-5 pt-5 pb-4">
                <h1 class="display-3 text-white mb-3 animated slideInDown">Dashboard</h1>
            </div>
        </div>

        <?php if ($user) { ?>
            <div class="dashboard-container">
                <div class="row">
                    <div class="col-lg-5 mb-5">
                        <div class="dashboard-profile-section p-5">
                            <img src="upload/<?= $user['pp'] ?>" class="img-fluid rounded-circle mb-5" style="max-width:200px;">
                            <h2 class="mb-2"><?= $user['fname'] ?>
                              
                            </h2>

                            <p class="mb-4">Hi! I'm an undergrad CSE student and also a great foodie. I make many foods but also want to share them with others. Hope I will be helpful. CIAO!</p>
                            <p class="mb-2"><strong>Email:</strong> <?= $user['email'] ?></p>
                            <a href="add_recipe.php" class="btn btn-primary mt-3 ">Add a Recipe</a>
                           
                        </div>
                        <div class="shadow ms-4 w-500 ">
                       
                        </div>
                    </div>
                    <div class="col-lg-7">
                        <h2 class="mb-4">My Recipes</h2>
                        <div class="row">
                            <?php
                            if ($recipes && is_array($recipes)) {
                                foreach ($recipes as $recipe) {
                            ?>
                                    <div class='col-md-6 mb-4'>
                                        <div class='recipe-card'>
                                            <a href="recipe.php?recipe_id=<?php echo htmlspecialchars($recipe['recipe_id']) ?>">
                                                <img src='recipe_img/<?php echo htmlspecialchars($recipe['picture']) ?>' onerror="this.src='recipe_img/default.jpg'" alt='<?php echo htmlspecialchars($recipe['recipe_name']); ?>'>
                                                <div class='overlay'>
                                                    <div class='text'>
                                                        <h3 class='text-white'><?php echo htmlspecialchars($recipe['recipe_name']); ?></h3>
                                                        <p>By <?php echo htmlspecialchars($user['fname']); ?></p>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                            <?php
                                }
                            } else {
                                echo "<p>No recipes found.</p>";
                            }
                            ?>
                        </div>
                    </div>

                    
                    <script>
                        function redirectToRecipe() {
                            window.location.href = "recipe.php=?id";
                        }

                        document.addEventListener('DOMContentLoaded', function() {
                            var buddyButton = document.getElementById('buddyButton');
                            
                            var closePopup = document.getElementById('closePopup');

                            if (buddyButton) {
                                buddyButton.addEventListener('click', function() {
                                    popup.style.display = 'block';
                                });
                            }

                            if (closePopup) {
                                closePopup.addEventListener('click', function() {
                                    popup.style.display = 'none';
                                });
                            }

                            // Close the popup if user clicks outside of it
                            window.addEventListener('click', function(event) {
                                if (event.target == popup) {
                                    popup.style.display = 'none';
                                }
                            });
                        });
                    </script>



                <?php
            } else {
                header("Location: login.php");
                exit;
            }



            include "template/footer.php";
                ?>
                <?php if (isset($_GET['show_chatbot'])): ?>
                    <div id="chatbot-container" style="position: fixed; bottom: 20px; right: 20px; width: 350px; height: 500px; z-index: 1000;">
                        <script>
                            window.embeddedChatbotConfig = {
                                chatbotId: "oSlgYJ4Rb-dM-44413px2",
                                domain: "www.chatbase.co"
                            }
                        </script>
                        <script
                            src="https://www.chatbase.co/embed.min.js"
                            chatbotId="oSlgYJ4Rb-dM-44413px2"
                            domain="www.chatbase.co"
                            defer>
                        </script>
                    </div>
                <?php endif; ?>
                <script>
                    window.addEventListener('load', function() {
                        let chatbotContainer = document.getElementById('chatbot-container');
                        if (chatbotContainer) {
                            let observer = new MutationObserver(function(mutations) {
                                mutations.forEach(function(mutation) {
                                    if (mutation.type === 'childList') {
                                        let chatbotIframe = chatbotContainer.querySelector('iframe');
                                        if (chatbotIframe) {
                                            chatbotIframe.addEventListener('load', function() {
                                                let chatWindow = chatbotIframe.contentWindow;
                                                let originalPostMessage = chatWindow.postMessage;

                                                chatWindow.postMessage = function(message, targetOrigin, transfer) {
                                                    if (typeof message === 'object' && message.type === 'message' && message.from === 'chatbot') {
                                                        sendToServer(message.text);
                                                    }
                                                    originalPostMessage.call(this, message, targetOrigin, transfer);
                                                };
                                            });
                                            observer.disconnect();
                                        }
                                    }
                                });
                            });

                            observer.observe(chatbotContainer, {
                                childList: true,
                                subtree: true
                            });
                        }
                    });

                   
                </script>

    </body>

    </html>

<?php
} else {
    header("Location: login.php");
    exit;
}
?>