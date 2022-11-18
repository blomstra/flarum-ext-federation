import app from 'flarum/forum/app';

import { extend } from 'flarum/common/extend';
import LogInButtons from 'flarum/forum/components/LogInButtons';
import LogInButton from 'flarum/forum/components/LogInButton';

app.initializers.add('blomstra/federation', () => {
    extend(LogInButtons.prototype, 'items', function (items) {
        items.add(
            'blomstra-federation',
            <div className="LogInButtonContainer LogInButtonContainer--federation">
                <LogInButton className={"Button LogInButton"} path={"/auth/blomstra/federation"}>
                {app.translator.trans(`blomstra-federation.forum.login.button`)}
                </LogInButton>
            </div>
        )
    });
});
