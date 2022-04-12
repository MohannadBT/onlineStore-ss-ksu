const products = [
  {
    ProductId: 1,
    image: "data:image/jpeg;base64,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",
    name: "Headphones",
    description: "Lorem ipsum dolor, sit amet consectetur adipisicing elit. Ullam, soluta. Eius, eveniet aliquid. Atque, doloribus Cum cupiditate eum reiciendis debitis modi illo, expedita laudantium non, amet voluptatem minus quod impedit",
    price: 325.99,
    
  },
  {
    ProductId: 2,
    image: "https://cdn.shopify.com/s/files/1/1859/8979/files/CPI-0158-inline-img-01.jpg?v=1553883913",
    name: "Watch ",
    description: "Adipisicing elit. Ullam, soluta. Eius, eveniet aliquid. Atque, doloribus Cum cupiditate eum reiciendis debitis modi illo, expedita laudantium non, amet voluptatem minus quod impedit",
    price: 178.25,
    
  },
  {
    ProductId: 3,
    image: "https://images.unsplash.com/photo-1542291026-7eec264c27ff?ixid=MnwxMjA3fDB8MHxzZWFyY2h8Nnx8cHJvZHVjdHxlbnwwfHwwfHw%3D&ixlib=rb-1.2.1&w=1000&q=80",
    name: "Shoes",
    description: "Lorem ipsum dolor, sit amet consectetur adipisicing elit. Ullam, soluta. Eius, eveniet aliquid. Atque, doloribus Cum cupiditate eum reiciendis debitis modi illo, expedita laudantium non, amet voluptatem minus quod impedit",
    price: 1000,
    
  },
  {
    ProductId: 4,
    image: "https://imgs.michaels.com/MAM/assets/1/726D45CA1C364650A39CD1B336F03305/img/91F89859AE004153A24E7852F8666F0F/10093625_r.jpg?fit=inside|540:540",
    name: "t-shirts",
    description: "Lorem ipsum dolor, sit amet consectetur adipisicing elit. Ullam, soluta. Eius, eveniet aliquid. Atque, doloribus Cum cupiditate eum reiciendis debitis modi illo, expedita laudantium non, amet voluptatem minus quod impedit",
    price: 50.41,
    
  },
  {
    ProductId: 5,
    // image: "	https://a.namshicdn.com/cms/large/women/20220302/feed/module_8_ar.png",
    image: "	https://i.ibb.co/sH2Tm9F/61-IJBs-Hm97-L.jpg",
    name: "Iphones",
    description: "Lorem ipsum dolor, sit amet consectetur adipisicing elit. Ullam, soluta. Eius, eveniet aliquid. Atque, doloribus Cum cupiditate eum reiciendis debitis modi illo, expedita laudantium non, amet voluptatem minus quod impedit",
    price: 30.50,
    
  },
  {
    ProductId: 6,
    image: "https://i.ibb.co/5jrPP0v/goui.jpg" ,
    name: "Battery",
    description: "Lorem ipsum dolor, sit amet consectetur adipisicing elit. Ullam, soluta. Eius, eveniet aliquid. Atque, doloribus Cum cupiditate eum reiciendis debitis modi illo, expedita laudantium non, amet voluptatem minus quod impedit",
    price: 45.90,
    
  },
  {
    ProductId: 7,
    image: "https://a.namshicdn.com/cms/large/women/20220302/feed/module_8_ar.png",
    name: "Bags",
    description: "Lorem ipsum dolor, sit amet consectetur adipisicing elit. Ullam, soluta. Eius, eveniet aliquid. Atque, doloribus Cum cupiditate eum reiciendis debitis modi illo, expedita laudantium non, amet voluptatem minus quod impedit",
    price: 99.45,
    
  }
  
];


let newIn = document.querySelector(".new");
// products.map((card)=>{
//    cards.innerHTML += ` <div class="card mb-3 p-3 id="${card.ProductId}"" >
//    <div class="row g-0">
//      <div class="col-md-3 text-center">
//        <img src="${card.image}" class="img-fluid rounded-start" alt="...">
//      </div>
//      <div class="col-md-6">
//        <div class="card-body">
//          <h5 class="card-title">${card.name}</h5>
//          <p class="card-text">${card.description}</p>
//          </p>
//        </div>
//      </div>
//      <div class="col-md-3 text-center">
//        <h5 class="price">${card.price}$</h5>
//        <h5 class="price">${card.status}</h5>
//        <button type="button" class="btn btn-primary w-75 my-3 ">Products</button>
//        <button type="button" class="btn btn-danger w-75">Delete</button>

//      </div>
//    </div>
//  </div>`
    

// })

products.map((card)=>{
  newIn.innerHTML += 
  ` <div class=" item item-categories  p-3 id="${card.ProductId}"" >
  
    <div class=" text-center item-img">
      <img src="${card.image}" class=" " alt="..."> 
      <h5 class="price mt-3">${card.name}</h5>
  </div>
</div>`
   

})

// let popular = document.querySelector(".popular");

// products.map((card)=>{
//   popular.innerHTML += ` <div class=" item  p-3 id="${card.ProductId}"" >
//   <div class="row g-0">
//     <div class=" text-center item-img">
//       <img src="${card.image}" class=" rounded-start" alt="...">
//     </div>
    
//     <div class=" text-center">
//       <h6 class="price mt-3">${card.price}$</h6>
      
     

//     </div>
//   </div>
// </div>`
   

// })

let currentScrollPosition = 0;
let scrollAmount = 120;
let scont = document.querySelector(".story-container")
const hScroll = document.querySelector(".horizontal-scroll")
let maxScroll = -scont.offsetWidth + hScroll.offsetWidth;

console.log(hScroll.offsetWidth)
const btn_scroll_right = document.querySelectorAll(".btn-scroll-right");
const btn_scroll_left = document.querySelectorAll(".btn-scroll-left");

// function scrollHorizontally(val){
//   console.log("yes")
//   currentScrollPosition += (val * scrollAmount);
//   scont.style.left = currentScrollPosition + "px"
// }

function scrollLeft(wrapper){
  if(window. innerWidth <=500){
    console.log(window.innerWidth , "yes")
    wrapper.scrollLeft += 200;
  }
  else
  wrapper.scrollLeft += 500;
}

function scrollRight(wrapper){
  
  if(window. innerWidth <=500){
    wrapper.scrollLeft -=200;
  }
  else
  wrapper.scrollLeft -=500;
}


// btn_scroll_right.onclick = function(){
 
//   newIn.scrollLeft += 120;
// }

for(let btn of btn_scroll_right){
  btn.addEventListener("click",()=>{
    let data = btn.getAttribute('data')
    let wrapper = document.querySelector("."+data)
    scrollLeft(wrapper)
  })
}
// btn_scroll_left.onclick = function(){
  
//   newIn.scrollLeft -= 120;
// }

for(let btn of btn_scroll_left){
  btn.addEventListener("click",()=>{
    let data = btn.getAttribute('data')
    let wrapper = document.querySelector("."+data)
    scrollRight(wrapper)
  })
}

