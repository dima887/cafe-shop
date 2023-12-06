import {useEffect} from 'react';
import {useDispatch, useSelector} from "react-redux";
import Cookies from "js-cookie";
import {
    addProduct,
    clearProducts,
    decrementProductQuantity,
    getTotalAmount,
    incrementProductQuantity, setProducts,
} from "../redux/actions/basket";

const useBasketFunctions = () => {

    const product = useSelector((state) => state.basket)
    const {id, name, price, quantity} = product.product;
    const dispatch = useDispatch();
    const totalAmount = useSelector((state) => state.totalAmount);

    useEffect(() => {
        setBasketFromCookie();
    }, [dispatch])

    const setBasketFromCookie = () => {
        const basketJson = Cookies.get('basket')
        const productsFromCookies = basketJson ? JSON.parse(basketJson) : {};
        //todo 15 => userId
        if (productsFromCookies[15]) {
            dispatch(setProducts(productsFromCookies[15]));
        }

        dispatch(getTotalAmount())
    }

    const setBasketInCookie = (id, name, price) => {

        const existingData = Cookies.get('basket');
        const existingBasket = existingData ? JSON.parse(existingData) : {};

        const newData = {
            user_id: 15,
            type_order_id: 1,
            product: {
                id: [id],
                name: [name],
                price: [price],
                quantity: [1]
            },
        };

        const objectId = `${newData.user_id}`;

        const existingObject = existingBasket[objectId];

        if (existingObject) {
            newData.product.id.forEach((productId, index) => {
                const existingIndex = existingObject.product.id.indexOf(productId);

                if (existingIndex !== -1) {
                    existingObject.product.quantity[existingIndex] += 1;
                } else {
                    existingObject.product.id.push(productId);
                    existingObject.product.name.push(newData.product.name[index]);
                    existingObject.product.price.push(newData.product.price[index]);
                    existingObject.product.quantity.push(newData.product.quantity[index]);
                }
            });
        } else {
            existingBasket[objectId] = newData;
        }

        const setProductToRedux = {
            id: id,
            name: name,
            price: price,
            quantity: 1
        };
        dispatch(addProduct(setProductToRedux));
        dispatch(getTotalAmount())

        Cookies.set('basket', JSON.stringify(existingBasket), { expires: 1 });
    }

    const handleIncrementQuantity = (productId) => {

        dispatch(incrementProductQuantity(productId));

        const productsFromCookies = JSON.parse(Cookies.get('basket'));
        //todo userId
        const productIndex = productsFromCookies[15].product.id.indexOf(productId);

        if (productIndex !== -1) {
            const newQuantity = [...productsFromCookies[15].product.quantity];
            newQuantity[productIndex] += 1;

            const setNewQuantity = JSON.stringify({
                15: {
                    ...productsFromCookies[15],
                    product: {
                        ...productsFromCookies[15].product,
                        quantity: newQuantity,
                    },
                }
            });
            dispatch(getTotalAmount())
            return Cookies.set('basket', setNewQuantity);
        }

    };

    const handleDecrementQuantity = (productId) => {
        dispatch(decrementProductQuantity(productId));

        //todo userId
        const productsFromCookies = JSON.parse(Cookies.get('basket'));
        const productDecrementIndex = productsFromCookies[15].product.id.indexOf(productId);

        if (productDecrementIndex !== -1) {
            const newQuantity = [...productsFromCookies[15].product.quantity];
            newQuantity[productDecrementIndex] -= 1;

            if (newQuantity[productDecrementIndex] === 0) {
                const updatedProduct = {
                    id: productsFromCookies[15].product.id.filter((id, index) => index !== productDecrementIndex),
                    name: productsFromCookies[15].product.name.filter((_, index) => index !== productDecrementIndex),
                    price: productsFromCookies[15].product.price.filter((_, index) => index !== productDecrementIndex),
                    quantity: newQuantity.filter((_, index) => index !== productDecrementIndex),
                };

                const setNewQuantity = JSON.stringify({
                    15: {
                        ...productsFromCookies[15],
                        product: updatedProduct,
                    }
                });
                dispatch(getTotalAmount())
                return Cookies.set('basket', setNewQuantity)
            }

            const setNewQuantity = JSON.stringify({
                15: {
                    ...productsFromCookies[15],
                    product: {
                        ...productsFromCookies[15].product,
                        quantity: newQuantity,
                    },
                }
            });
            dispatch(getTotalAmount())
            return Cookies.set('basket', setNewQuantity)
        }
    };

    const clearBasket = () => {
        Cookies.remove('basket');
        dispatch(clearProducts());
    }


    return { product, id, name, price, quantity, totalAmount, setBasketInCookie, handleIncrementQuantity, handleDecrementQuantity, clearBasket};
};

export default useBasketFunctions;
