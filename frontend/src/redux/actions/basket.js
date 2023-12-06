export const addProduct = (newProduct) => ({
    type: 'ADD_PRODUCT',
    payload: newProduct,
});

export const setProducts = (products) => ({
    type: 'SET_PRODUCTS',
    payload: products,
});

export const incrementProductQuantity = (productIncrementId) => ({
    type: 'INCREMENT_PRODUCT_QUANTITY',
    payload: { productIncrementId },
});

export const decrementProductQuantity = (productDecrementId) => ({
    type: 'DECREMENT_PRODUCT_QUANTITY',
    payload: { productDecrementId },
});

export const getTotalAmount = () => ({
    type: 'GET_TOTAL_AMOUNT',
});

export const clearProducts = () => ({
    type: 'CLEAR_PRODUCTS',
});

export const loginUser = (user) => ({
    type: 'LOGIN_USER',
    payload: user,
});

export const logoutUser = () => ({
    type: 'LOGOUT_USER',
});