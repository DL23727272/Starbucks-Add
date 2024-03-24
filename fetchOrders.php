<?php
    session_start();
    function getTotalOrders() {
        return 5; 
    }
   
    function displayOrders() {
        $totalOrders = getTotalOrders();
        for ($i = 0; $i < $totalOrders; $i++) {

            $accordionId = "accordion$i";
            $collapseId = "collapse$i";
            
            echo "<div>";
            echo "Order number: $i";
            echo "</div>";
            echo "<div class='accordion' id='$accordionId' style='width: 100%;'>";
            echo "<div class='accordion-item'>";
            echo "<h2 class='accordion-header'>";
            echo "<button class='accordion-button' type='button' data-bs-toggle='collapse' data-bs-target='#$collapseId' aria-expanded='true' aria-controls='$collapseId'>";
            echo "View Order";
            echo "</button>";
            echo "</h2>";
            echo "<div id='$collapseId' class='accordion-collapse collapse' data-bs-parent='#$accordionId'>";
            echo "<div class='accordion-body'>";
            echo "Lorem ipsum dolor sit, amet consectetur adipisicing elit. In earum, voluptatibus sit labore nesciunt explicabo eaque vero corrupti quod ex dolores maiores modi sunt error velit necessitatibus iste molestiae expedita.";
            echo "</div>";
            echo "</div>";
            echo "</div>";
            echo "</div>";
        }
    }

    // Call the function to generate HTML content
    displayOrders();
?>
