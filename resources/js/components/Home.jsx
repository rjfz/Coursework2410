import React, { useEffect, useState, useRef } from 'react'
import ReactDOM from 'react-dom'
import Item from './Item'

function update_value(element, callback) {
    var value = parseInt(element.current.value)
    callback(value)
}

const Home = (props) => {
    const categories = JSON.parse(props.categories)
    const user = props.user ? JSON.parse(props.user) : {}
    const approvals = props.approvals == 'true' ? true : false
    const requests = props.requests == 'true' ? true : false

    const [filter_value, setFilterValue] = useState(0)
    const [items, setItems] = useState(JSON.parse(props.items))
    const filter_ref = useRef(null);

    useEffect(() => {
        if (filter_value == 0) {
            setItems(JSON.parse(props.items))
        } else {
            setItems(JSON.parse(props.items).filter(item => {
                return item.category_id == filter_value
            }))
        }
    }, [filter_value])

    const items_elements = items.map(item => {
        return <Item item={item} approvals={approvals} requests={requests} user_id={user.id} editable={item.reported_by == user.id || user.role == 'admin'} />
    })

    const category_values = categories.map(category => {
        return <option value={category.id}>{category.name}</option>
    })

    return (
        <div>
            Show only:
            <select id="filter_category" className="form-control text-capitalize" ref={filter_ref} onChange={() => {update_value(filter_ref, setFilterValue)}}>
                <option value="0">All</option>
                {category_values}
            </select>
            <br />
            <div className="row card-row auth-height text-center">
                {items_elements}
            </div>
        </div>
    )
}

export default Home

if (document.getElementById('home_component')) {
    var props = Object.assign({}, document.getElementById('home_component_props').dataset)
    ReactDOM.render(<Home {...props} />, document.getElementById('home_component'))
}
