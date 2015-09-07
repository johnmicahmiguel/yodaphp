<div class="modal-ajax"></div>


<?php
if (isset($this->js))
{
    foreach ($this->js as $js)
    {
        echo '<script type="text/javascript" src="'.URL.'views/'.$js.'"></script>';
    }
}
?>
</body>
</html>