<?php
if (isset($_GET['success'])) {
    echo '<script>
        swal("Success!", "Your message has been sent successfully!", "success");
    </script>';
}
?>
