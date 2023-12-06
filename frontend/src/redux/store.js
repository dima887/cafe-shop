import { createStore, combineReducers } from 'redux';
import userReducer from './reducers/user';
import basketReducer from './reducers/basket';

const rootReducer = combineReducers({
    user: userReducer,
    basket: basketReducer,
});

const store = createStore(rootReducer);

export default store;