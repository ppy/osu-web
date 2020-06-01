// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import { ReactNode } from 'react';
import { createPortal } from 'react-dom';

export const Portal = ({children}: { children: ReactNode }) => createPortal(children, document.body);
