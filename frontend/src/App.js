import logo from './logo.svg';
import './App.css';
import http from "./axios";
import React from "react";
import Routes from "./router/Routes";


function App() {

    // const payment = (event) => {
    //     event.preventDefault();
    //
    //     //test stripe
    //     http.post('api/payment', {
    //         user_id: 1,
    //         type_order_id: 1,
    //         product: {
    //             id: [2, 1],
    //             name: ['Lattes', 'Hot-dogidog'],
    //             price: [5.50, 8.99],
    //             quantity: [1, 3],
    //         },
    //         success_url: 'http://localhost:3000/?success=true',
    //         cancel_url: 'http://localhost:3000/?success=false',
    //     })
    //         .then((res) => {
    //             console.log(res);
    //             window.location.href = res.data.success;
    //         })
    //         .catch((er) => {
    //             console.log(er)
    //         })
    // }


  return (


    <div className="App">
         <Routes/>
        {/*<section>*/}
        {/*    <div className="product">*/}
        {/*        <img*/}
        {/*            src="https://i.imgur.com/EHyR2nP.png"*/}
        {/*            alt="The cover of Stubborn Attachments"*/}
        {/*        />*/}
        {/*        <div className="description">*/}
        {/*            <h3>Stubborn Attachments</h3>*/}
        {/*            <h5>$20.00</h5>*/}
        {/*        </div>*/}
        {/*    </div>*/}
        {/*    <form>*/}
        {/*        <button onClick={payment} type="submit">*/}
        {/*            Checkout*/}
        {/*        </button>*/}
        {/*    </form>*/}
        {/*</section>*/}
    </div>
  );
}

export default App;
