<?php
/**
 * Material Design Popup Notification System
 * This file can be included in any PHP script to display a styled popup notification.
 */

function showPopup($message = "Notification", $title = "Information", $icon = "fas fa-info-circle", $duration = 5000)
{
    // Generate a unique ID
    $popupId = 'popup_' . uniqid();
    
    // Output the HTML structure for the notification
    echo <<<HTML
    <div id="notificationContainer" class="notification-container"></div>
    <template id="materialTemplate">
        <div class="notification material-notification slide-in-right">
            <div class="icon">
                <i class="$icon"></i>
            </div>
            <div class="content">
                <div class="message">$message</div>
            </div>
            <button class="close">&times;</button>
            <div class="progress-bar-container">
                <div class="progress-bar"></div>
            </div>
        </div>
    </template>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    
    <style>
        body {
            /* padding: 20px; */
            /* font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; */
        }
        
        /* Notification container */
        .notification-container {
            position: fixed;
            top: 30px;
            right: 20px;
            z-index: 1050;
            display: flex;
            flex-direction: column;
            gap: 10px;
            pointer-events: none;
            max-width: 350px;
        }
        
        .notification-container .notification {
            pointer-events: auto;
        }
        
        /* Base notification styles */
        .notification {
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
            opacity: 0;
            margin-bottom: 10px;
            position: relative;
        }
        
        /* Material Design style */
        .material-notification {
            background-color: white;
            border-left: 4px solid #3f51b5;
            padding: 16px;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }
        
        .material-notification .icon {
            color: #3f51b5;
            font-size: 20px;
            margin-right: 8px;
            display: flex;
            align-items: center;
        }
        
        .material-notification .content {
            flex: 1;
            display: flex;
            align-items: center;
        }
        
        .material-notification .message {
            color: #666;
            font-size: 14px;
            display: inline;
        }
        
        .material-notification .close {
            color: #999;
            background: none;
            border: none;
            font-size: 16px;
            padding: 0;
            margin-left: 12px;
            cursor: pointer;
        }
        
        /* Animation - slide from right */
        .slide-in-right {
            transform: translateX(120%);
            transition: transform 0.4s cubic-bezier(0.18, 0.89, 0.32, 1.28), opacity 0.3s ease;
        }
        
        .slide-in-right.show {
            transform: translateX(0);
            opacity: 1;
        }
        
        /* Progress bar */
        .progress-bar-container {
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            height: 3px;
            background-color: rgba(0, 0, 0, 0.1);
        }
        
        .progress-bar {
            height: 100%;
            background-color: #3f51b5;
            width: 100%;
            transition: width linear;
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const container = document.getElementById('notificationContainer');
            const template = document.getElementById('materialTemplate');
            
            function showNotification(delay = $duration) {
                const notificationElement = template.content.cloneNode(true).children[0];
                container.appendChild(notificationElement);
                
                const progressBar = notificationElement.querySelector('.progress-bar');
                if (progressBar) {
                    progressBar.style.width = '100%';
                    progressBar.style.transition = `width {delay}ms linear`;

                    setTimeout(() => { progressBar.style.width = '0'; }, 50);
                }
                
                setTimeout(() => { notificationElement.classList.add('show'); }, 10);
                
                setTimeout(() => {
                    notificationElement.classList.remove('show');
                    setTimeout(() => { notificationElement.remove(); }, 500);
                }, delay);
                
                const closeButton = notificationElement.querySelector('.close');
                closeButton.addEventListener('click', () => {
                    notificationElement.classList.remove('show');
                    setTimeout(() => { notificationElement.remove(); }, 500);
                });
            }
            
            showNotification();
        });
    </script>
    HTML;
}
?>
