import Toolbar from '../../components/Toolbar/Toolbar';
import SideDrawer from '../../components/SideDrawer/SideDrawer';
const layout = (props) => <div>
                         <Toolbar/>
                         <SideDrawer/>
                         <main>{props.children}</main>
                     </div>
  
export default layout;