import React from 'react'
import ReactDOM from 'react-dom'

const Item = (props) => {
    const item = props.item
    const editable = props.editable
    const approvals = props.approvals
    const requests = props.requests
    const user_id = props.user_id

    const date_reported = new Date(item.date_reported)

    var content

    if (approvals || (requests && item.reported_by != user_id && user_id != undefined)) {
        content = <div className="card-footer">
            <div className="row">
                { approvals ? <div className="col-sm-6"><a className="btn btn-success" href={"/item/approve/" + item.id}>Approve</a></div> : '' }
                { approvals ? <div className="col-sm-6"><a className="btn btn-danger" href={"/item/deny/" + item.id}>Deny</a></div> : '' }
                { (requests && item.reported_by != user_id && user_id != undefined) ? <div className="col-sm-12"><a className="btn btn-primary" href={"/item/request/" + item.id}>Request item</a></div> : '' }
            </div>
        </div>
    } else {
        content = ''
    }

    return (
        <div className="col-md-4">
            <div className="card mb-3 w-100">
                <div className="card-body">
                    <a aria-current="page" className="card-link" href={editable ? ("/item/edit/" + item.id) : ("/item/show/" + item.id)}>
                        <img className="card-img-top" src={"/images/" + (item.images.length > 0 ? item.images[0].path : 'placeholder.png')} />
                        <div className="card-body">
                            <h3 className="card-title text-capitalize">{item.category.name}</h3>
                            <p className="card-text">{item.route_lost_on}</p>
                            <p className="card-text text-muted">{date_reported.toLocaleDateString("en-GB")}</p>
                        </div>
                    </a>
                </div>
                {content}
            </div>
        </div>
      )
}

export default Item
