
<head>
    <link rel="stylesheet" href="<?php echo URLROOT ?>/public/css/style.css">
</head>

<main role ="main" id="history-main">
    <section class="nav-bar">
        <?php
        require APPROOT . '/views/includes/navigation.php';
        ?>
    </section>
    <section class="main-history-container">

        <section class="intro-history-container">
            <h1 id="history-tickets-h">Tour Schedule</h1>

            <section class="history-ticket-dropdown-container">
                <label for="history-ticket-dropdown" id="history-dropdown-btn">Select a language</label>
                <select id="history-ticket-dropdown">
                    <option value="lang_chinese">Chinese</option>
                    <option value="lang_dutch">Dutch</option>
                    <option value="lang_english">English</option>
                </select>
            </section>
            <section class="history-calendar-container">
                <table id="history-table">
                    <thead>
                    <th>Day</th>
                    <th>Time</th>
                    <th>Language</th>
                    <th>Select</th>
                    </thead>
                    <tr>
                        <td>day</td>
                        <td>time</td>
                        <td>language</td>
                        <td>Select</td>
                    </tr>
                    <tr>
                        <td>day</td>
                        <td>time</td>
                        <td>language</td>
                        <td>Select</td>
                    </tr>
                    <tr>
                        <td>day</td>
                        <td>time</td>
                        <td>language</td>
                        <td>Select</td>
                    </tr>
                    <tr>
                        <td>day</td>
                        <td>time</td>
                        <td>language</td>
                        <td>Select</td>
                    </tr>
                    <tr>
                        <td>day</td>
                        <td>time</td>
                        <td>language</td>
                        <td>Select</td>
                    </tr>
                    <tr>
                        <td>day</td>
                        <td>time</td>
                        <td>language</td>
                        <td>Select</td>
                    </tr>

                    <tr>
                        <td>day</td>
                        <td>time</td>
                        <td>language</td>
                        <td>Select</td>
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

    function ShowModal() {

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