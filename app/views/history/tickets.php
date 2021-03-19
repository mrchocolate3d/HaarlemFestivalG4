<?php

?>

<head>
    <link rel="stylesheet" href="<?php echo URLROOT ?>/public/css/style.css">
</head>

<main role ="main">
    <section class="nav-bar">
        <?php
        require APPROOT . '/views/includes/navigation.php';
        ?>
    </section>
    <section class="history-page-container">
        <section class="history-tickets-container">
            <section class="history-ticket-container">
                <button onclick="myFunction()" id="history-dropdown-btn">Select a language</button>
                <section class="history-ticket-dropdown">
                    <a href="#chinese">Chinese</a>
                    <a href="#english">English</a>
                    <a href="#dutch">Dutch</a>
                </section>
            </section>

            <section class="history-calendar-days">
                <ul id="history-calendar-day-names">
                    <li>Thursday</li>
                    <li>Friday</li>
                    <li>Saturday</li>
                    <li>Sunday</li>
                </ul>
            </section>
            <aside class="history-calender-timestamps">
                <ul id="history-calendar-times">
                    <li>10:00</li>
                    <li>13:00</li>
                    <li>16:00</li>
                </ul>
            </aside>

            <section class="history-calendar-container">
                <table>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>

                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>

                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>

                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                </table>
            </section>

            <section class="history-tickets-modal">
                <span id="history-tickets-modal-close"></span>
            </section>

        </section>
    </section>
</main>

<script>

    function myFunction() {
        document.getElementsByClassName("history-ticket-dropdown").classList.toggle("show");
    }

    function filterFunction() {
        var input;
        var filter;
        var ul, li, a, i;
        input = document.getElementById("myInput");
        filter = input.value.toUpperCase();
        dropdown = document.getElementById("myDropdown");

        a = dropdown.getElementsByTagName("a");
        for (i = 0; i < a.length; i++) {
            value = a[i].textContent || a[i].innerText;
            if (value.toUpperCase().indexOf(filter) > -1) {
                a[i].style.display = "";
            } else {
                a[i].style.display = "none";
            }
        }
    }
    var click = document.getElementById("map_popup_btn");
    var modal=document.getElementsByClassName("history-tickets-modal");
    var closebtn = document.getElementById("history-tickets-modal-close");
    click.onclick=function (){
        modal.style.display = "block";
    }
    closebtn.onclick=function (){
        modal.style.display="close";
    }

    window.onclick = function(event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }





</script>