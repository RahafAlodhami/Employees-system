
  <?php

  if ($_SERVER["REQUEST_METHOD"] == "POST") {
      $name = $_POST['name'];
      $ID = $_POST['ID'];
      $Department = $_POST['Department'];

      // FILE INFO
      $file_name = $_FILES['image']['name']; // image.jpg ["image", "jpg"]
      $file_size = $_FILES['image']['size'];
      $file_tmp = $_FILES['image']['tmp_name'];

      $new_file_name = uploadingFile($file_name, $file_size, $file_tmp);
      if(!$new_file_name) {
          die("Error in uploading the file");
      }

      // STORING THE DATA INTO A JSON FILE

      $data = "Name: $name , ID: $ID , Department: $Department , Image: $new_file_name\n";
      $json= json_encode($data);
      file_put_contents('myfile.json', $json);
      $a1 =array("$name","$ID", "$Department");
      echo (json_decode($json));
      echo "<br>";
      echo "Employee added successfully!";

  }


  function uploadingFile($file_name, $file_size, $file_tmp) {
      $file_name_exploded = explode('.', $file_name);
      $array_counter = array_key_last($file_name_exploded);
      $file_ext = $file_name_exploded[$array_counter];

      $accepted_extensions = ['jpg', 'png', 'gif', 'jpeg'];

      // CHECK FILE EXTENSION
      if(!in_array($file_ext, $accepted_extensions)) {
          die("Hay you are trying to hack our website");
      }

      // CHECK FILE SIZE IS BIGGER THAN 2 MBS
      if($file_size > 2097152) {
          die("Your file size is too large");
      }

      $rand_number = uniqid();
      $new_file_name = $rand_number.$file_name;


      return $new_file_name;
  }
