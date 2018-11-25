const React = require('react');
const ReactDOM = require('react-dom');

if (typeof usingReactApp !== "undefined") {
    ReactDOM.render(
        <h1>Hello, world!</h1>,
        document.getElementById('root')
    );
}