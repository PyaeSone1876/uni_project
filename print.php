<!DOCTYPE html>
<html>
<head>
    <title></title>
</head>
<body>
<script>
        function printDiv(divName){
            var printContents = document.getElementById(divName).innerHTML;
            var originalContents = document.body.innerHTML;

            document.body.innerHTML = printContents;

            window.print();

            document.body.innerHTML = originalContents;

        }
</script>
<h1> do not print this </h1>

<div id='printMe'>
  <table border="1">
      <tr>
          <td>No</td>
          <td>Student Name</td>
          <td>Address</td>
      </tr>
      <tr>
          <td>1</td>
          <td>Aung Aung</td>
          <td>Yangon</td>
      </tr>
      <tr>
          <td>2</td>
          <td>Hla Wai</td>
          <td>Mandalay</td>
      </tr>
      <tr>
          <td>2</td>
          <td>Hla Wai</td>
          <td>Mandalay</td>
      </tr>
      <tr>
          <td>2</td>
          <td>Hla Wai</td>
          <td>Mandalay</td>
      </tr>
      <tr>
          <td>2</td>
          <td>Hla Wai</td>
          <td>Mandalay</td>
      </tr>
  </table>
</div>

<button onclick="printDiv('printMe')">Print only the above div</button>

</body>
</html>