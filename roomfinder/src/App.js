import React, {Suspense} from 'react';
import { Route, Switch, Redirect } from 'react-router-dom';
import Layout from './container/Layout/Layout';
import FindProperty from './container/FindProperty/FindProperty';
import UploadProperty from './container/UploadProperty/UploadProperty';
import AvailableProperty from './container/AvailableProperty/AvailableProperty';
import DeleteProperty from './container/DeleteProperty/DeleteProperty';
import AboutUs from './container/AboutUs/AboutUs';
import Login from './container/Login/Login';
import Register from './container/Register/Register';
import ResertPasswordAuthenticate from './container/ResertPasswordAuthenticate/ResertPasswordAuthenticate';
import ResertPassword from './container/ResertPassword/ResertPassword';

const App = () => {

  let route = <Switch>
                   <Route path="/" exact component={FindProperty} />
                   <Route path="/upload_property" exact component={UploadProperty} />
                   <Route path="/available_property" exact component={AvailableProperty} />
                   <Route path="/delete_property" exact component={DeleteProperty} />
                   <Route path="/about_us" exact component={AboutUs} />
                   <Route path="/login" exact component={Login} />
                   <Route path="/register" exact component={Register} />
                   <Route path="/resert_password_auth" exact component={ResertPasswordAuthenticate} />
                   <Route path="/resert_password" exact component={ResertPassword} />
                   <Redirect to="/" />
                </Switch> 

    return <Layout>
                <Suspense fallback={<p>Loading...</p>}>{route}</Suspense>
            </Layout>
} 
  
export default App;
