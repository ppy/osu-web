import { BeatmapsetJson } from "beatmapsets/beatmapset-json";
import { PopupMenuPersistent } from "popup-menu-persistent";
import * as React from "react";
import { ReportReportable } from "report-reportable";

interface Props {
    beatmapset: BeatmapsetJson;
}

export default class BeatmapsetMenu extends React.PureComponent<Props> {
    render() {
        const { beatmapset } = this.props;

        const children = () => (
            <ReportReportable
                className='simple-menu__item'
                icon={true}
                key='report'
                reportableId={beatmapset.id.toString()}
                reportableType='beatmapset'
                user={beatmapset.user}
            />
        );

        return (
            <PopupMenuPersistent>
                {children}
            </PopupMenuPersistent>
        );
    }
}