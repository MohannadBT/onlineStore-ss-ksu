<?php if(isset($_SESSION['email'])){  ?>
<script>
  let btn_cart = document.querySelectorAll('.btn-cart');
    for(let btn of btn_cart){
      btn.addEventListener("click",()=>{
        var email = '<?= $_SESSION['email'] ?>';
        $.post(`insert_cart.php`,{id:event.currentTarget.id,email:email},function(data,status,xhr){
          console.log(data)
        let nav = document.querySelector('#cart-num');
        console.log(nav.textContent,"txt")
        nav.textContent = parseInt(nav.textContent)+1;
        
      //   $("#cart-num").load("fetch_cart_number.php",function(responseTxt, statusTxt, xhr){
      //     if(statusTxt == "error")
      // alert("Cart num cannot load!");
      //   })

})

      })
    }
</script>

<?php }?>