import { combineReducers, configureStore } from '@reduxjs/toolkit';

import { sessionReducer as session } from './session';
import { tickerReducer as ticker } from './ticker';

const reducer = combineReducers({
    session,
    ticker,
});

export { sessionActions } from './session';
export { tickerActions } from './ticker';

export default configureStore({
    reducer
});
