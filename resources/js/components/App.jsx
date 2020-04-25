import React from 'react';
import ReactDOM from 'react-dom';
import { BrowserRouter as Router, Route, Switch } from 'react-router-dom';
import Home from './Home'

function App() {
    return (
        <Router>
            <Switch>
                <Route path="/" exact component={Home} />
                {/* <Route path="/About" component={About} />
                <Route path="/Contact" component={Contact} />
                <Route component={NotFound} /> */}
            </Switch>
        </Router>
    );
}

export default App;

if (document.getElementById('react_app')) {
    ReactDOM.render(<App />, document.getElementById('react_app'));
}
