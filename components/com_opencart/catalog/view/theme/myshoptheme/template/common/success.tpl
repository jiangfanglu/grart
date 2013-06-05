
<div id="content">
  <h1><?php echo $heading_title; ?></h1>
  <?php echo $text_message; ?><br/>
  Redirecting......
  <script>
      setTimeout(5000);
      document.location.href="/index.php?option=com_opencart";
  </script>
</div>