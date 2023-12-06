const initialState = {
    user_id: null,
    type_order_id: null,
    product: {
        id: [],
        name: [],
        price: [],
        quantity: []
    },
    success_url: "",
    cancel_url: ""
};

const productReducer = (state = initialState, action) => {
    switch (action.type) {
        case 'ADD_PRODUCT':
            const productIdIndex = state.product.id.indexOf(action.payload.id);

            if (productIdIndex !== -1) {
                const newQuantity = state.product.quantity.slice();
                newQuantity[productIdIndex] += 1;

                return {
                    ...state,
                    product: {
                        ...state.product,
                        quantity: newQuantity,
                    },
                };
            } else {
                return {
                    ...state,
                    product: {
                        id: [...state.product.id, action.payload.id],
                        name: [...state.product.name, action.payload.name],
                        price: [...state.product.price, action.payload.price],
                        quantity: [...state.product.quantity, 1],
                    },
                };
            }

        case 'SET_PRODUCTS':
            return {
                ...state,
                ...action.payload,
            };

        case 'INCREMENT_PRODUCT_QUANTITY':
            const { productIncrementId } = action.payload;


            const productIncrementIndex = state.product.id.indexOf(productIncrementId);

            if (productIncrementIndex !== -1) {
                const newQuantity = [...state.product.quantity];
                newQuantity[productIncrementIndex] += 1;

                return {
                    ...state,
                    product: {
                        ...state.product,
                        quantity: newQuantity,
                    },
                };
            }
            return state;

        case 'DECREMENT_PRODUCT_QUANTITY':
            const { productDecrementId } = action.payload;
            const productDecrementIndex = state.product.id.indexOf(productDecrementId);

            if (productDecrementIndex !== -1) {
                const newQuantity = [...state.product.quantity];
                newQuantity[productDecrementIndex] -= 1;

                if (newQuantity[productDecrementIndex] === 0) {
                    const updatedProduct = {
                        id: state.product.id.filter((id, index) => index !== productDecrementIndex),
                        name: state.product.name.filter((_, index) => index !== productDecrementIndex),
                        price: state.product.price.filter((_, index) => index !== productDecrementIndex),
                        quantity: newQuantity.filter((_, index) => index !== productDecrementIndex),
                    };

                    return {
                        ...state,
                        product: updatedProduct,
                    };
                }

                return {
                    ...state,
                    product: {
                        ...state.product,
                        quantity: newQuantity,
                    },
                };
            }
            return state;

        case 'GET_TOTAL_AMOUNT':
            const totalAmount = state.product.price.reduce((total, price, index) => {
                return parseFloat((total + price * state.product.quantity[index]).toFixed(2));
            }, 0);

            return {
                ...state,
                totalAmount,
            };

        case 'CLEAR_PRODUCTS':
            return initialState;

        default:
            return state;
    }
};

export default productReducer;
