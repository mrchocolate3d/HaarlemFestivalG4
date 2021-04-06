

<main role ="main" id="history-main">
    <section class="nav-bar">
        <?php
        require APPROOT . '/views/includes/header.php';
        require APPROOT . '/views/includes/navigation.php';
        ?>
    </section>
    <section class="main-history-container">

        <section class="intro-history-container">
            <h1 id="history-tickets-h">Tour Schedule</h1>


            <section class="history-ticket-dropdown-container">
                <label for="history-ticket-dropdown" id="history-dropdown-btn">Select a language</label>
                <form method="post" action="<?php echo URLROOT; ?>/histories/tickets">
                    <select name="ticket_dropdown" id="history-ticket-dropdown">
                        <option name="Chinese" value="Chinese">Chinese</option>
                        <option name="Dutch" value="Dutch">Dutch</option>
                        <option name="English" value="English">English</option>
                    </select>
                    <input type="submit" name="filter-language">
                    <button name="reset-language">Show all languages</button>
                </form>
            </section>
            <section class="history-calendar-container">
                <table id="history-table">
                    <thead>
                    <th>Date</th>
                    <th>Time</th>
                    <th>Language</th>
                    <th>Guide</th>
                    <th>Select</th>
                    </thead>
                    <?php
                    foreach ($data as $datum){?>
                        <tr>
                        <td><?php echo $datum['tour_date']?></td>
                        <td><?php echo $datum['starting_time']?></td>
                        <td><?php echo $datum['lang']?></td>
                        <td><?php echo $datum['tour_guide']?></td>
                        <td>
                            <a href="<?php echo URLROOT; ?>/histories/add?event_id=<?php echo $datum['history_event_id'];?>">Order tickets</a>

                        </td>
                        </tr><?php }?>
                </table>
            </section>

            <section class="history-tickets-modal">
                <span id="history-tickets-modal-close"></span>
            </section>

        </section>
    </section>
</main>

<script>

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
    var click = document.getElementById("history-select-tour");
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
    }
</script>




