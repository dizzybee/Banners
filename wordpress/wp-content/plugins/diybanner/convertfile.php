<?php

echo "temp filename >> ".$_FILES["jjfile"]["tmp_name"];
if ($_FILES["jjfile"]["error"] > 0)
  {
  echo "Error: " . $_FILES["jjfile"]["error"] . "<br>";
  }
else
  {
  // Read image path, convert to base64 encoding
$imgData = base64_encode(file_get_contents($_FILES["jjfile"]["tmp_name"]));

// Format the image SRC:  data:{mime};base64,{data};
$src = 'data: '.mime_content_type($_FILES["jjfile"]["tmp_name"]).';base64,'.$imgData;

// Echo out a sample image
echo $src;
  }
?>