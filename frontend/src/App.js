import logo from './logo.svg';
import './App.css';
import http from "./axios";
import React from "react";


function App() {

    const payment = (event) => {
        event.preventDefault();

        //test stripe
        http.post('api/payment', {
            user_id: 1,
            type_order_id: 1,
            product: {
                id: [2, 1],
                name: ['Lattes', 'Hot-dogidog'],
                price: [5.50, 8.99],
                quantity: [1, 3],
            },
            success_url: 'http://localhost:3000/?success=true',
            cancel_url: 'http://localhost:3000/?success=false',
        })
            .then((res) => {
                console.log(res);
                window.location.href = res.data;
            })
            .catch((er) => {
                console.log(er)
            })
    }


  return (
        // <Routes/>

    <div className="App">
      <header className="App-header">
        <img src={logo} className="App-logo" alt="logo" />
        <p>
          Edit <code>src/App.js</code> and save to reload.
        </p>
        <a
          className="App-link"
          href="https://reactjs.org"
          target="_blank"
          rel="noopener noreferrer"
        >
          Learn React
        </a>
      </header>

        <section>
            <div className="product">
                <img
                    src="https://i.imgur.com/EHyR2nP.png"
                    alt="The cover of Stubborn Attachments"
                />
                <div className="description">
                    <h3>Stubborn Attachments</h3>
                    <h5>$20.00</h5>
                </div>
            </div>
            <form>
                <button onClick={payment} type="submit">
                    Checkout
                </button>
            </form>
        </section>
    </div>
  );
}

export default App;
